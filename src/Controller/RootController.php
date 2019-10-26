<?php

namespace App\Controller;

use App\Entity\UniversallyIdentifiableInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * RootController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/headers", methods={"GET"})
     * @param UserInterface|null $user
     * @return Response
     */
    public function index(UserInterface $user = null)
    {
        if ($user instanceof UniversallyIdentifiableInterface) {
            $content = $user->getId();
        } else {
            $content = 'No user id available.';
        }
        return new Response($content);
    }
}
