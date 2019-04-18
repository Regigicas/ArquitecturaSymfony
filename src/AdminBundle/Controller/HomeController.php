<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{

    public function getHomeAction()
    {
        // Obtenemos todas las multas del infractor y las pasamos al twig dentro del array
        
        $credencial = $this->get("session")->get("credencial");
        if (!$credencial)
            throw new AccessDeniedHttpException();

        $em = $this->getDoctrine()->getManager();
        $multas = $em->getRepository("DBBundle:Multas")->findBy( array("admin" => $credencial) );
        
        return $this->render('AdminBundle:Home:home.html.twig', array( "multas" => $multas ));
    }

}
