<?php

namespace App\Controller;

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
     */
    public function index(Request $request, UserInterface $user)
    {
        $username = $user->getUsername();
        return new Response($username);
    }
}
