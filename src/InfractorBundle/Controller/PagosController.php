<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagosController extends Controller
{

    public function pagoTarjetaAction()
    {
        $request = $this->getRequest();

        if ($request->getMethod() != "POST")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarTarjeta.html.twig');
        }
        else
        {
            return $this->render('InfractorBundle:ElegirPago:elegirPago.html.twig');
        }
    }

    public function pagoPayPalAction()
    {
        $request = $this->getRequest();

        if($request->getMethod() != "POST")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarPayPal.html.twig');
        }
        else
        {
            return $this->render('InfractorBundle:ElegirPago:elegirPago.html.twig');
        }
    }

    //tarjeta
    public function comprobarYFinalizarAction()
    {
        //En este método se comprueba que los datos de la tarjeta son correctos (form validate), y si eso se finaliza el pago

        $request = $this->getRequest();
        $form = $this->createFormBuilder(null, array())
                ->add("nombre_titular", "text")
                ->add("numero_tarjeta", "number")
                ->add("fecha_caducidad", "text")
                ->add("CVV", "number", ["constraints" => new Length(["min" => 3, "minMessage" => "El CVV debe contener 3 dígitos", "max"=> 3 , "maxMessage"=> "El CVV tiene como máximo 3 dígitos" ])])
                ->getForm();

        if ($request->getMethod() == "GET")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarTarjeta.html.twig', array(
                "form" => $form->createView()
            ));
        }
        else
        {
            $form->bind($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                //Treh
                
                $nombre_titular = $form->get("nombre_titular")->getData();
                $numero_tarjeta = $form->get("numero_tarjeta")->getData();
                $fecha_caducidad = $form->get("fecha_caducidad")->getData();
                $CVV = $form->get("CVV")->getData();

                //Actualizar a estado 1 de la multa pasada por sesiones
                $idMulta = $this->get("session")->get("idMulta");

                $bd = $em->getRepository("DBBundle:Multas");
                

                //Redirigir

                $this->redirect($this->generateUrl("home_infractor"));

            
                
            }
        }
    }

    //pay-pal
    public function comprobarYFinalizarPPAction()
    {
        //en este método, como no tenemos api de PP (ni de VoX *ba dum tss*), lo que hacemos es finalizar el pago y darlo como bueno si al menos el formulario es correcto (form validate)

        $request = $this->getRequest();
        $form = $this->createFormBuilder(null, array())
                ->add("usuario", "text")
                ->add("contraseña", "text")
                ->getForm();

        if ($request->getMethod() == "GET")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarPayPal.html.twig', array(
                "form" => $form->createView()
            ));
        }
    }
}
