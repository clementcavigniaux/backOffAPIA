<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Parameter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManager;

class ParameterController extends Controller
{
    /**
     * @Route("/parametre", name="parameter")
     */
    public function showParameter(){

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $param = $em->getRepository(Parameter::class)->findAll();

        return $this->render('Parameter/parameter.html.twig', array( 'param' => $param,));

    }


    /**
     * @Route("/modif-price" , name="modifprix")
     */

    public function modifPrix(){

        $real = $_POST['PrixReal'];
        $prod = $_POST['PrixProd'];
        $id="1";


            $prod = str_replace(',','.', $prod);
            $real = str_replace(',','.', $real);

        if(is_numeric($real) or is_float($real) and is_numeric($prod) or is_float($prod)) {

            $em = $this->container->get("doctrine.orm.default_entity_manager");
            $update = $em->getRepository(Parameter::class)->find($id);

            $update->setPrixReal($real);
            $update->setPrixProd($prod);

            $em->flush();
        }else{
            header("HTTP/1.0 404 Not Found");
            $error = "NaN";
            echo json_encode(['response' => $error]);
            exit( 0 );
        }
        return $this->render('Home/Home.html.twig');

    }

    /**
     * @Route("/modif-banque" , name="modifbanque")
     */

    public function modifBanque(){

        $id="1";
        $numCompte = $_POST['numCompte'];
        $NomBanque = $_POST['NomBanque'];


        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $update = $em->getRepository(Parameter::class)->find($id);

        $update->setNumCompte($numCompte);
        $update->setNomBanque($NomBanque);

        $em->flush();

        return $this->render('Home/Home.html.twig');

    }

    /**
     * @Route("/modif-administratif", name="modifadministratif")
     */

    public function modifAdmini(){

        $id="1";

        $adresse = $_POST['adresseApia'];
        $tel = $_POST['telApia'];
        $siret = $_POST['SIRETAPIA'];
        $numAPIA = $_POST['numAPIA'];

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $update = $em->getRepository(Parameter::class)->find($id);


        $update->setAdresseAPIA($adresse);
        $update->setTelAPIA($tel);
        $update->setSIRETAPIA($siret);
        $update->setNumAPIA($numAPIA);

        $em->flush();

        return $this->render('Home/Home.html.twig');
    }

}