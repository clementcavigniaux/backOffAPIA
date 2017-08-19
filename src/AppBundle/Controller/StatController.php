<?php


namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class StatController extends Controller
{

    /**
     * @Route("/statistique", name="stat")
     */

    public function showStat(){
        return $this->render('Statistique/stats.html.twig');
    }

}