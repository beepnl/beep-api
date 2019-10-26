<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class CognitoAuthenticator
 * @package App\Security
 * @author George van Vliet
 */
class CognitoAuthenticator extends AbstractGuardAuthenticator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    private $cognitoJwks;

    const AUTHORIZATION_HEADER_NAME = 'Authorization';
    const AUTHORIZATION_HEADER_VALUE_PREFIX = 'Bearer';

    /**
     * CognitoAuthenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param JsonWebKeySet $cognitoJwks
     * @param UuidInterface|null $id
     */
    public function __construct(EntityManagerInterface $entityManager, JsonWebKeySet $cognitoJwks, UuidInterface $id = null)
    {
        $this->entityManager = $entityManager;
        $this->cognitoJwks = $cognitoJwks;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    public function supports(Request $request)
    {
        return $request->headers->has('Authorization') && preg_match('#^Bearer#', $request->headers->get('Authorization'));
    }

    public function getCredentials(Request $request)
    {
        $token = $this->extractToken($request);

        if (!$token) {
            return null;
        }

        return [
            'token' => $token
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $credentials['token'];

        try {
            $token = JWT::decode($token, $this->cognitoJwks->getKeys(), ['RS256']);
            $subject = $token->sub;
            $id = Uuid::fromString($subject);
            $user = $this->entityManager->getRepository(User::class)->find($id);
            if (!$user) {
                $user = $this->createAndPersistUserAccount($id);
            }

            return $user;
        } catch (\Exception $e) {
            throw new AuthenticationException($e->getMessage());
        }
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }

    private function extractToken(Request $request)
    {
        if (!$request->headers->has(static::AUTHORIZATION_HEADER_NAME)) {
            return false;
        }

        $authorizationHeader = $request->headers->get('Authorization');
        $pieces = explode(' ', $authorizationHeader);

        if (!(2 === count($pieces) && 0 === strcasecmp($pieces[0], static::AUTHORIZATION_HEADER_VALUE_PREFIX))) {
            return false;
        }

        return $pieces[1];
    }

    private function createAndPersistUserAccount(UuidInterface $id)
    {
        $user = new User($id);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
