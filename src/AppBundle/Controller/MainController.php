<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class MainController extends Controller
{
    /**
     * @Route("/", name="main")
     */
    public function showMain(){

        return $this->render('base.html.twig');
    }

}