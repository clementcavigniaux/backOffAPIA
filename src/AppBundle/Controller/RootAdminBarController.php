<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RootAdminBarController extends Controller
{
    public function showNavbarAdmin()
    {
        return $this->render('Admin/NavbarAdmin.html.twig');
    }
}
