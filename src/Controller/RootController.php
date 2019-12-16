<?php

namespace App\Controller;

use App\Entity\IdentifiableInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Twig\Environment;

/**
 * Class RootController
 * @package App\Controller
 * @author George van Vliet
 */
class RootController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var Environment
     */
    private $twig;

    /**
     * RootController constructor.
     * @param EntityManagerInterface $em
     * @param Environment $twig
     */
    public function __construct(EntityManagerInterface $em, Environment $twig)
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    /**
     * @Route("/headers", methods={"GET"})
     * @param UserInterface|null $user
     * @return Response
     */
    public function index(UserInterface $user = null)
    {
        if ($user instanceof IdentifiableInterface) {
            $content = $user->getId();
        } else {
            $content = 'No user id available.';
        }
        return new Response($content);
    }

    /**
     * @Route("/bundles/apiplatform/swagger-ui/oauth2-redirect.html")
     *
     * This route only works in production.
     */
    public function OAuth2Redirect() {
        return new Response(file_get_contents('https://assets.stichtingbeep.nl/bundles/apiplatform/swagger-ui/oauth2-redirect.html'));
    }
}
