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

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(n) FROM AppBundle:Brouillon n');
        $count = $query->getResult();

        foreach ($count as $item) {
            $result = $item[1];
        }
        $brouillon = $result;

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT COUNT(n) FROM AppBundle:Devis n');
        $count = $query->getResult();

        foreach ($count as $item) {
            $result = $item[1];
        }
        $devis = $result;


        $query = $em->createQuery('SELECT COUNT(c) FROM AppBundle:Client c');
        $count = $query->getResult();

        foreach ($count as $item) {

            $result = $item[1];
        }
        $client = $result;

        return $this->render('Home/home.html.twig', array('devis' => $devis, 'nbBrouillon' => $brouillon, 'client' => $client));

}
}