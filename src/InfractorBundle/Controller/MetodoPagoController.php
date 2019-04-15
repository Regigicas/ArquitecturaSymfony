<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MetodoPagoController extends Controller
{
    public function getMetodosPagoAction()
    {
        $request = $this->getRequest();

        if($request->getMethod() == "POST")
        {
            return;
        }

        return $this->render('InfractorBundle:ElegirPago:elegirPago.html.twig');
    }

    /*public function getMetodoPayPalAction()
    {
        $request = $this->getRequest();

        if($request->getMethod() == "GET")  // GET
        {
            return $this->render('InfractorBundle:ElegirPago:pagarPayPal.html.twig');
        }
        else                                // POST
        {

        }
    }

    public function getMetodoTarjetaAction()
    {
        $request = $this->getRequest();

        if($request->getMethod() == "GET")  // GET
        {
            return $this->render('InfractorBundle:ElegirPago:pagarTarjeta.html.twig');
        }
        else                                // POST
        {

        }
    }*/


}
