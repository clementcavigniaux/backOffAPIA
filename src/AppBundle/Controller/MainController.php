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


            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT COUNT(n) FROM AppBundle:Brouillon n');
            $count = $query->getResult();

            foreach ($count as $item) {
                $nb = $item[1];
            }


        return $this->render('base.html.twig', array('nbBrouillon' => $nb));
    }

}