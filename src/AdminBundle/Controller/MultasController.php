<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DBBundle\Entity\Multas;
use DBBundle\Form\MultasType;

class MultasController extends Controller
{
    public function getDetallesMultaAction()
    {
        $request = $this->getRequest();
        if ($request->getMethod() != "POST")
            return $this->redirect($this->generateUrl("get_home_admin"));

        // Se obtiene la multa que se le va a pasar
        
        $multaId = $request->get("multa");
        $em = $this->getDoctrine()->getManager();
        $multa = $em->getRepository("DBBundle:Multas")->find($multaId);
        $session = $this->get("session")->set("idMulta", $multaId);

        // Render de la multa

        return $this->render('AdminBundle:DetallesMulta:detallesMulta.html.twig', array( "multa" => $multa) );
    }

    public function newMultaAction()
    {
        $request = $this->getRequest();

        $em = $this->getDoctrine()->getManager();
        $matriculas = $em->getRepository("DBBundle:Matriculas")->findAll();

        $multa = new Multas();
        $form = $this->createForm(new MultasType($matriculas), $multa);

        if ($request->getMethod() == "GET")
            return $this->render('AdminBundle:Multa:newMulta.html.twig', array("form" => $form->createView()));
        else
        {
            // Posteo de la multa, tras validar tanto formulario como campos
            $form->bind($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                $session = $this->get("session");
                $credencial = $session->get("credencial");
                $adminCredencial = $em->getRepository("DBBundle:Admins")->find($credencial);
                $nuevaMatricula = $form->get("matricula")->getData();
                $usuarioCredencial = $form->get("matricula")->getData()->getNBastidor()->getCredencial();

                $multa->setAdmin($adminCredencial);
                $multa->setCredencial($usuarioCredencial);
                $multa->setEstado(0);

                $errores = $this->get("validator")->validate($multa);
                $hayErrores = false;
                if (sizeof($errores) > 0)
                {
                    $hayErrores = true;
                    foreach ($errores as $error)
                        $session->getFlashBag()->add("error", $error);
                }

                if (!$multa->validateMatricula($nuevaMatricula))
                {
                    $hayErrores = true;
                    $session->getFlashBag()->add("error", "La matrícula no tiene un formato valido");
                }

                $now = new \DateTime(date("Y-m-d"));
                if ($multa->getFecha() > $now)
                {
                    $hayErrores = true;
                    $session->getFlashBag()->add("error", "La fecha no puede ser superior al día actual"); 
                }

                if ($hayErrores)
                    return $this->render("AdminBundle:Multa:newMulta.html.twig", array( "form" => $form->createView() ));

                // Insert en la bd
                $em->persist($multa);
                $em->flush();
                
                return $this->redirect($this->generateUrl("get_home_admin"));
            }

            return $this->render('AdminBundle:Multa:newMulta.html.twig', array("form" => $form->createView()));
        }
    }
}
