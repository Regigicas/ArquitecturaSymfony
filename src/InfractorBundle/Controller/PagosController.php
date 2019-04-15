<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagosController extends Controller
{

    public function pagoTarjetaAction()
    {
        $request = $this->getRequest();

        if($request->getMethod() == "POST")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarTarjeta');
        }
        else
        {
            return $this->render('InfractorBundle:ElegirPago:elegirPago');
        }
    }

    public function pagoPayPalAction()
    {
        $request = $this->getRequest();

        if($request->getMethod() == "POST")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarPayPal');
        }
        else
        {
            return $this->render('InfractorBundle:ElegirPago:elegirPago');
        }
    }

    public function comprobarYFinalizarAction()
    {
        //En este método se comprueba que los datos de la tarjeta son correctos, y si eso se finaliza el pago
    }

    public function comprobarYFinalizarPPAction()
    {
        //en este método, como no tenemos api de PP, lo que hacemos es finalizar el pago y darlo como bueno si al menos el formulario es correcto
    }
}
