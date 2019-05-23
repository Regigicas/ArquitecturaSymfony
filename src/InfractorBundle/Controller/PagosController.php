<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Date;

class PagosController extends Controller
{
    //tarjeta
    public function comprobarYFinalizarAction()
    {
        //En este método se comprueba que los datos de la tarjeta son correctos (form validate), y si eso se finaliza el pago

        $request = $this->getRequest();
        $form = $this->createFormBuilder(null, array())
                ->add("nombre_titular", "text", ["constraints" => new Regex([ "pattern" => "/^[A-Za-z ñ]+$/", "message" => "El nombre no puede contener números"])])
                ->add("numero_tarjeta", "text", ["constraints" => new Regex([ "pattern" => "/[[:digit:]]{4} [[:digit:]]{4} [[:digit:]]{4} [[:digit:]]{4}$/", "message" => "El número de la tarjeta no es valido"])])
                ->add("fecha_caducidad", "date", [ "years" => range(date('Y') , date('Y') + 5),
                    "months" => range(1, 12),
                    "days" => range(1, 31),
                    "invalid_message" => "La fecha no es válida",
                    "constraints" => new Date([ "message" => "La fecha no es válida" ]) ])
                ->add("CVV", "number", ["constraints" => new Length(["min" => 3, "max"=> 3 , "exactMessage"=> "El CVV tiene que estar formado por 3 dígitos" ])])
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
                
                $session = $this->get("session");
                $nombre_titular = $form->get("nombre_titular")->getData();
                $numero_tarjeta = $form->get("numero_tarjeta")->getData();
                $fecha_caducidad = $form->get("fecha_caducidad")->getData();
                $now = new \DateTime(date("Y-m-d"));
                if ($fecha_caducidad < $now)
                {
                    $session->getFlashBag()->add("error", "La fecha no puede ser inferior al día actual");
                    return $this->render('InfractorBundle:ElegirPago:pagarTarjeta.html.twig', array(
                        "form" => $form->createView()));
                }

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
                ->add("email_paypal", "email")
                ->add("contrasena_paypal", "password")
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
