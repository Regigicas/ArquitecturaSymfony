<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

//Este controlador actuará para ir a la home del infractor y conseguir los datos de la base de datos que se le mostrarán en la pantalla principal

class HomeController extends Controller
{
    public function getHomeAction()
    {
        return $this->render('InfractorBundle:Home:get_home.html.twig', array());
    }

}
