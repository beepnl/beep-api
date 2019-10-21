<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;

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

    /**
     * CognitoAuthenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param JsonWebKeySet $cognitoJwks
     */
    public function __construct(EntityManagerInterface $entityManager, JsonWebKeySet $cognitoJwks)
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
        $token = trim(explode(' ', $request->headers->get('Authorization'), 2)[1]);

        return [
            'token' => $token
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $credentials['token'];

        try {
            $token = JWT::decode($token, $this->cognitoJwks->getKeys(), ['RS256']);
            $username = $token->username;
            return $this->entityManager->getRepository(User::class)->findOneBy(['username' => $username]);
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
}
