<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Brouillon;
use AppBundle\Entity\Parameter;
use AppBundle\Entity\Client;
use AppBundle\Entity\Devis;
use AppBundle\Form\DevisType;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Repository\DevisRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Session\Session;


class DevisController extends Controller
{




    /**
     * @Route("/devis", name="devis")
     */


    public function showList()
    {

        return $this->render('Devis/listDevis.html.twig');

    }

    /**
     * @Route("/devistab", name="TabDevis")
     */

    public function getTable(){

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $client = $em->getRepository(Client::class)->createQueryBuilder('e')->join('AppBundle:Devis', 'r')->where('r.idClient = e.id')->getQuery()->getResult();

        $query = $em->createQuery('SELECT COUNT(n) FROM AppBundle:Devis n');
        $count = $query->getResult();

        $query2 = $em ->createQuery('SELECT MAX(l.id) FROM AppBundle:Devis l');
        $last = $query2->getResult();

        foreach ($count as $item) {
            $nb = $item[1];
        }
            if ($nb > 0) {
                if (!empty($_POST['min'])) {
                    $min = $_POST['min'];


                    if (!empty($_POST['page'])) {
                        $page = $_POST['page'];
                    } else {
                        $page = 1;
                    }

                } else {
                    $min = $last;
                    $page = 1;
                }
                if(!empty($_POST['req'])){

                    $req = $_POST['req'];
                    $page = $_POST['page'];
                    $em = $this->container->get("doctrine.orm.default_entity_manager");
                    $query = $em->createQuery('SELECT d FROM AppBundle:Devis d WHERE d.titreProjet LIKE :req OR d.typePresta LIKE :req')->setParameter('req' , '%'.$req.'%');
                    //$query = $em->createQuery('SELECT d, c FROM AppBundle:Devis d JOIN AppBundle::Client c ON d.idClient = c.id  WHERE  d.titreProjet LIKE :req OR d.typePresta LIKE :req')->setParameter('req' , '%'.$req.'%');
                    $devis = $query->getResult();
                    $nbPage = 0;

                }elseif($min <= $last) {
                    $em = $this->getDoctrine()->getManager();
                    $query = $em->createQuery('SELECT d FROM AppBundle:Devis d WHERE d.id <= :min ORDER BY d.id DESC')->setParameter('min', $min)->setMaxResults(10);
                    $devis = $query->getResult();

                $nbPage = ceil($nb / 10);
                }


                $listPage = [];

                for ($i = 0; $i < $nbPage; $i++) {

                    $somme = $i + 1;
                    $listPage[] = $somme;
                }
            } else {
                $devis = [];
                $nbPage = 0;
                $page = 0;
                $listPage = NULL;
            }
        return $this->render('Devis/tabDevis.html.twig', array( 'listdevis' => $devis, 'listClient' => $client, 'maxResult' => $nb, 'nbPage' => $nbPage, 'page' => $page, 'listPage' => $listPage));
    }

    /**
     * @Route("/update-devis", name="UpdateDevis")
     */


    public function updateDevis(){

    }

    /**
     * @Route("/delete-devis", name="deleteDevis")
     */

    public function deleteDevis(){

        if($_POST['id']) {
            $id = $_POST['id'];

            $em = $this->getDoctrine()->getManager();

            foreach ($id as $item) {


                $query = $em->createQuery('DELETE FROM AppBundle:Devis s WHERE s.id = :id')->setParameter('id', $item);
                $delete = $query->getResult();
            }



        }
        return $this->render('/');
    }

    /**
     * @Route("/devis-single", name="singleDevis")
     */

    public function showDevis(){

        $id = $_POST['id'];
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $devis = $em->getRepository(Devis::class)->findBy(array('id' => $id));

        return $this->render('Devis/Single.html.twig', array( 'devis' => $devis));
    }

    /**
     * @Route("/brouillons", name="brouillons")
     */

    public function showBrouillons(){

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $req = $em->getRepository(Brouillon::class)->findAll();


        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $client = $em->getRepository(Client::class)->createQueryBuilder('e')->join('AppBundle:Devis', 'r')->where('r.idClient = e.id')->getQuery()->getResult();

        return $this->render('Devis/Brouillons/brouillons.html.twig', array('listbrouillon' => $req , 'listClient' => $client));
    }

    /**
     * @Route("/brouillon-single", name="singleBrouillon")
     */

    public function showsingleBrouillon()
    {
        $id = $_POST['id'];
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $req = $em->getRepository(Brouillon::class)->findBy(array('id' => $id));

        return $this->render('Devis/Brouillons/single.html.twig',  array('brouillon' => $req));
    }

    /**
     * @Route("/add-brouillon", name="addBrouillon")
     */

    public function addBrouillon(){

        return $this->render('/');
        $datetime = new \DateTime();

        $client = $_POST['idClient'];
        $titre = $_POST['titreProjet'];
        $prixTotal = $_POST['prixTotal'];


        $date = $datetime->format('Y-m-d H:i:s');
        $user = $this->getUser();

        $typeArray = array();
        $typeArray = $_POST['typePresta'];

        foreach ($typeArray as $st1){

            $type[] = $st1["typePresta"];
            $qty[] = $st1["qty"];
            $prixU[] = $st1["prixUnitaire"];
            $prixCat[] = $st1["prixCategorie"];
        }

        $brouillon = new Brouillon();

        $brouillon->setIdClient($client);
        $brouillon->setTitreProjet($titre);
        $brouillon->settypePresta($type);
        $brouillon->setQty($qty);
        $brouillon->setprixUnitaire($prixU);
        $brouillon->setprixCategorie($prixCat);
        $brouillon->setPrixTotal($prixTotal);
        $brouillon->setDateCreation($date);
        $brouillon->setIdUser($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($brouillon);
        $em->flush();



        return $this->render('/');

    }

    /**
     * @Route("/create-devis", name="createdevis")
     */

    public function newAction(Request $request)
    {

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $param = $em->getRepository(Parameter::class)->findAll();


        $datetime = new \DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $devis = new Devis();
        $form = $this->createForm(DevisType::class, $devis, array(
            'attr' => array(
                'id' => 'formCreateDevis'
            )
        ));
        $form->handleRequest($request);


        if($form->isValid()) {
            $devis =$form->getData();
            $devis->dateCreation = $date;

            $user = $this->getUser();
            $devis->idUser = $user;

            $typeArray = array();
            $typeArray = $_POST['typePresta'];


            foreach ($typeArray as $st1){

                $type[] = $st1["typePresta"];
                $qty[] = $st1["qty"];
                $prixU[] = $st1["prixUnitaire"];
                $prixCat[] = $st1["prixCategorie"];
            }

            $devis->settypePresta($type);
            $devis->setQty($qty);
            $devis->setprixUnitaire($prixU);
            $devis->setprixCategorie($prixCat);


            $client = $_POST['idClient'];
            $devis->setidClient($client);

            $em = $this->getDoctrine()->getManager();
            $em->persist($devis);
            $em->flush();

            $response = new JsonResponse();
            $response->setStatusCode(200);

            $response->setData(array(
                'success' => "c good"));

            $query = $em->createQuery('SELECT MAX(l) AS Maxid FROM AppBundle:Devis l');
            $last = $query->getResult();

            foreach ($last as $item){
                $id = $item['Maxid'];
            }

            $session = new Session();

            $session->set('idDevis' , $id);


        }else{
            $response = new JsonResponse();
            $response->setStatusCode(412);
            $response->setData(array(
                'success' => 'non '));
        }

        return $this->render('Devis/createDevis.html.twig', array( 'form' => $form->createView(), 'param' => $param,
        ));
    }

    /**
     * @Route("/pdf-devis-editor", name="devispdfeditor")
     */

    public function PDFEditor(Request $request){

     $session = $request->getSession();
       $id =  $session->get('idDevis');
       //$session->remove('idDevis');

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $devis = $em->getRepository(Devis::class)->findBy(array('id' => $id));

        var_dump($devis);

        $html = $this->renderView('views:Devis:devispdf.html.twig', array(
            'some'  => $devis
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );



        //return $this->render('Devis/PDF/devispdf.html.twig', array('data' => $devis));


    }

}