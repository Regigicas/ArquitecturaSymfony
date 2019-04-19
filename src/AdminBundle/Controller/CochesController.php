<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DBBundle\Entity\Coches;
use DBBundle\Entity\Matriculas;
use DBBundle\Form\CochesType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CochesController extends Controller
{

    public function newCocheAction()
    {
        $request = $this->getRequest();

        $credencial = $this->get("session")->get("credencial");
        if (!$credencial)
            throw new AccessDeniedHttpException();

        $em = $this->getDoctrine()->getManager();
        $dnis = $em->getRepository("DBBundle:Infractor")->findAll();

        $dnisFormatted = array();
        foreach ($dnis as $dni)
            $dnisFormatted[$dni->getCredencial()] = $dni->getCredencial();

        $coche = new Coches();
        $form = $this->createForm(new CochesType($dnisFormatted), $coche);

        if ($request->getMethod() == "GET")
            return $this->render('AdminBundle:Coche:newCoche.html.twig', array("form" => $form->createView(), "dnis" => $dnis));
        else
        {
            $form->bind($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $session = $this->get("session");
                $errores = $this->get("validator")->validate($coche);
                $hayErrores = false;
                if (sizeof($errores) > 0)
                {
                    $hayErrores = true;
                    foreach ($errores as $error)
                        $session->getFlashBag()->add("error", $error);
                }

                $nuevaMatricula = $form->get("matricula")->getData();
                if (!$coche->validateMatricula($nuevaMatricula))
                {
                    $hayErrores = true;
                    $session->getFlashBag()->add("error", "La matrícula no tiene un formato valido");
                }

                if ($hayErrores)
                    return $this->render("AdminBundle:Coche:newCoche.html.twig", array("form" => $form->createView()));

                $em->persist($coche);
                $em->flush();

                $objMatricula = new Matriculas();
                $objMatricula->setCoche($coche);
                $objMatricula->setMatricula($nuevaMatricula);
                $em->persist($objMatricula);
                $em->flush();

                return $this->redirect($this->generateUrl("get_home_admin"));
            }

            return $this->render("AdminBundle:Coche:newCoche.html.twig", array( "form" => $form->createView() ));
        }
    }
}
