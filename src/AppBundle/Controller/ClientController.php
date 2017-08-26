<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Client;
use AppBundle\Form\ClientType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManager;

class ClientController extends Controller
{
    /**
     * @Route("/nouveau-client", name="newclient")
     */

    public function newClient(Request $request)
    {

        $client = new Client();
        $form = $this->createForm(ClientType::class, $client, array(
            'attr' => array(
                'id' => 'formNewUser', 'class' => 'test')
        ));
        $form->handleRequest($request);

        if($form->isValid()) {

            $client =$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            $response = new JsonResponse();
            $response->setStatusCode(200);

            $response->setData(array(
                'success' => "Client Ajouté"));
            return $response;

        }else{
            $response = new JsonResponse();
            $response->setStatusCode(412);
            $response->setData(array(
                'error' => $this->renderView('Client/NewClient.html.twig',
                    array('form' => $form->createView() )
                ),
            ));
        }

        return $this->render('Client/NewClient.html.twig', array( 'form' => $form->createView(),
        ));

    }
    /**
     * @Route("/client", name="client")
     */
    public function ListClient(){




        return $this->render('Client/ListClient.html.twig');
    }

    /**
     * @Route("/tabClient", name="tabClient")
     */

    public function getTable(){

        $em = $this->container->get("doctrine.orm.default_entity_manager");

        $query = $em->createQuery('SELECT COUNT(c) FROM AppBundle:Client c');
        $count = $query->getResult();

        $query2 = $em ->createQuery('SELECT MAX(c.id) FROM AppBundle:Client c');
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
                $query = $em->createQuery('SELECT c FROM AppBundle:Client c WHERE c.email LIKE :req OR c.nom LIKE :req')->setParameter('req' , '%'.$req.'%');
                $client = $query->getResult();
                $nbPage = 0;

            }elseif($min <= $last) {

                $query = $em->createQuery('SELECT c FROM AppBundle:Client c WHERE c.id <= :min ORDER BY c.nom ASC')->setParameter('min', $min)->setMaxResults(10);
                $client = $query->getResult();

                $nbPage = ceil($nb / 10);
            }


            $listPage = [];

            for ($i = 0; $i < $nbPage; $i++) {

                $somme = $i + 1;
                $listPage[] = $somme;
            }
        } else {
            $client = [];
            $nbPage = 0;
            $page = 0;
            $listPage = NULL;
        }
        return $this->render('Client/tabClient.html.twig', array('listclient' => $client, 'maxResult' => $nb, 'nbPage' => $nbPage, 'page' => $page, 'listPage' => $listPage));
    }


    /**
     * @Route("/update-client", name="UpdateClient")
     */
    public function UpdateClient(){

        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $type = $_POST['type'];
        $rue = $_POST['rue'];
        $ville = $_POST['ville'];
        $cp = $_POST['CP'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $siret = $_POST['siret'];
        $iban = $_POST['iban'];
        $interlo = $_POST['interlo'];

        $em = $this->container->get("doctrine.orm.default_entity_manager");
    $update = $em->getRepository(Client::class)->find($id);

    $update->setNom($nom);
    $update->setType($type);
    $update->setRue($rue);
    $update->setVille($ville);
    $update->setCP($cp);
    $update->setTel($tel);
    $update->setEmail($email);
    $update->setSIRET($siret);
    $update->setIBAN($iban);
    $update->setInterlocuteur($interlo);

    $em->flush();

        return $this->render('Home/Home.html.twig');

    }

    /**
     * @Route("/delete-client" , name="RemoveClient")
     */

public function RemoveClient(Request $request){

    $id = $_POST['id'];

    $em = $this->container->get("doctrine.orm.default_entity_manager");
    $rmv = $em->getRepository(Client::class)->find($id);

    $em->remove($rmv);
    $em->flush();

    return $this->render('Home/Home.html.twig');

}


    /**
     * @Route("/singleclient", name="singleClient")
     */

    public function MoreClient(Request $request){

        $id = $_POST;
        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $client = $em->getRepository(Client::class)->findBy(array('id' => $id));

                return $this->render('Client/SingleClient.html.twig', array('listtest' => $client));

    }


}