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

        $query = $em->createQueryBuilder()
                            ->select("m.fecha", "m.razon", "m.reclamada", "m.direccion", "m.precio", "m.estado",
                                     "m.matricula", "a.nombreAdmin", "m.credencial", "m.id",
                                     "i.nombre", "i.apellidos", "i.tlf", "i.fExpCarnet")
                            ->from("DBBundle:Multas", "m")
                            ->leftJoin("DBBundle:Admins", "a", \Doctrine\ORM\Query\Expr\Join::WITH, "m.admin = a.credencialAdmin")
                            ->leftJoin("DBBundle:Infractor", "i", \Doctrine\ORM\Query\Expr\Join::WITH, "m.credencial = i.credencial")
                            ->where("m.id = :id")
                            ->setParameter(":id", $multaId)
                            ->getQuery();

        $multa = $query->getResult();

        $session = $this->get("session")->set("idMulta", $multaId);

        // Render de la multa

        return $this->render('AdminBundle:DetallesMulta:detallesMulta.html.twig', array( "multa" => $multa[0]) );
    }

    public function newMultaAction()
    {
        $request = $this->getRequest();

        $em = $this->getDoctrine()->getManager();
        $matriculas = $em->getRepository("DBBundle:Matriculas")->findAll();

        $matriculasFormatted = array();
        $coches = array();
        foreach ($matriculas as $matricula)
        {
            $matriculasFormatted[$matricula->getMatricula()] = $matricula->getMatricula();
            $coches[$matricula->getMatricula()] = $matricula->getCoche();
        }

        $multa = new Multas();
        $form = $this->createForm(new MultasType($matriculasFormatted), $multa);

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
                $nuevaMatricula = $form->get("matricula")->getData();
                $usuarioCredencial = $coches[$nuevaMatricula]->getCredencial();

                $multa->setAdmin($credencial);
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

                if ($hayErrores)
                    return $this->render("AdminBundle:Multa:newMulta.html.twig", array( "form" => $form->createView() ));

                // Insert en la bd
                $em->merge($multa);
                $em->flush();
                
                return $this->redirect($this->generateUrl("get_home_admin"));
            }

            return $this->render('AdminBundle:Multa:newMulta.html.twig', array("form" => $form->createView()));
        }
    }
}
