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

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $client = $em->getRepository(Client::class)->findAll();
        return $this->render('Client/ListClient.html.twig', array( 'listclient' => $client));
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

    /**
     * @Route("/jointest", name="join")
     */

    public function JoinClient(){

        $idClient = $_POST;

        $em = $this->container->get("doctrine.orm.default_entity_manager");
        $client = $em->getRepository(Client::class)->createQueryBuilder('e')->join('AppBundle:Devis', 'r')->where('r.idClient = e.id')->getQuery()->getResult();


        return $this->render('test.html.twig', array( 'data' => $client));
    }


}