<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;




class HomeController extends Controller
{

    /**
     * @Route("/home", name="home")
     */

    public function showHome()
    {


        return $this->render('Home/home.html.twig');

}
}