<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Length;

class PagosController extends Controller
{
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

                // Actualizar a estado 2 de la multa pasada por sesiones
                $idMulta = $this->get("session")->get("idMulta");
                $em = $this->getDoctrine()->getManager();
                $multa = $em->getRepository("DBBundle:Multas")->find($idMulta);
                if (!$multa)
                    throw new NotFoundHttpException("No se encuentra la multa con el id $idMulta!");
                
                $multa->setEstado(2);
                $em->flush();

                // Redirigir
                return $this->redirect($this->generateUrl("get_home"));   
            }

            return $this->render('InfractorBundle:ElegirPago:pagarTarjeta.html.twig', array(
                "form" => $form->createView()
            ));
        }
    }

    //pay-pal
    public function comprobarYFinalizarPPAction()
    {
        //en este método, como no tenemos api de PP (ni de VoX *ba dum tss*), lo que hacemos es finalizar el pago y darlo como bueno si al menos el formulario es correcto (form validate)

        $request = $this->getRequest();
        $form = $this->createFormBuilder(null, array())
                ->add("email_paypal", "text")
                ->add("contrasena_paypal", "text")
                ->getForm();

        if ($request->getMethod() == "GET")
        {
            return $this->render('InfractorBundle:ElegirPago:pagarPayPal.html.twig', array(
                "form" => $form->createView()
            ));
        }
        else
        {
            $form->bind($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                //Treh
                
                $email_paypal = $form->get("email_paypal")->getData();
                $contrasena_paypal = $form->get("contrasena_paypal")->getData();

                // Actualizar a estado 2 de la multa pasada por sesiones
                $idMulta = $this->get("session")->get("idMulta");
                $em = $this->getDoctrine()->getManager();
                $multa = $em->getRepository("DBBundle:Multas")->find($idMulta);
                if (!$multa)
                    throw new NotFoundHttpException("No se encuentra la multa con el id $idMulta!");
                
                $multa->setEstado(2);
                $em->flush();

                // Redirigir
                return $this->redirect($this->generateUrl("get_home"));   
            }

            return $this->render('InfractorBundle:ElegirPago:pagarPayPal.html.twig', array(
                "form" => $form->createView()
            ));
        }
    }
}
