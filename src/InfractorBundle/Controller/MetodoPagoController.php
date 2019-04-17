<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MetodoPagoController extends Controller
{
    public function getMetodosPagoAction()
    {
        $request = $this->getRequest();

        if ($request->getMethod() != "POST")
            return $this->redirect($this->generateUrl("get_home"));
        return $this->render('InfractorBundle:ElegirPago:elegirPago.html.twig');
    }

}
