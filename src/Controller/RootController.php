<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RootController
 * @package App\Controller
 * @author George van Vliet
 */
class RootController
{
    /**
     * @Route("/headers", methods={"GET"})
     */
    public function index(Request $request)
    {
        foreach ($request->headers as $name => $value) {
            foreach ($value as $v) {
                echo sprintf("%s: %s", $name, $v) . "<br/>";
            }

        }
        return new Response();
    }
}
