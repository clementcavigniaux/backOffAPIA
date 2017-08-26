<?php
/**
 * Created by PhpStorm.
 * User: clementcavigniaux
 * Date: 22/08/2017
 * Time: 12:25
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class PDFController extends Controller
{

    /**
     * @Route("/pdf", name="pdf")
     */
    public function testPDF(){

        $html = $this->renderView('Devis/devispdf.html.twig');

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            )
        );
    }

}