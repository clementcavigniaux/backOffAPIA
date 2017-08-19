<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class HeaderController extends Controller
{
    /**
     * @Route("/header", name="header")
     */
    public function showHeader()
    {

        return $this->render('Header/header.html.twig');

    }


}