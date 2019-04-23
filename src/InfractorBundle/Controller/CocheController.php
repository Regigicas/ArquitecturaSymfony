<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DBBundle\Entity\Coches;
use DBBundle\Entity\Matriculas;
use DBBundle\Form\CochesType;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CocheController extends Controller
{
    public function getFormularioCocheAction()
    {
        $request = $this->getRequest();
        $credencial = $this->get("session")->get("credencial");
        if (!$credencial)
            throw new AccessDeniedHttpException();

        $coche = new Coches();
        $coche->setCredencial($credencial);
        $form = $this->createForm(new CochesType(null), $coche);
        if ($request->getMethod() == "GET")
            return $this->render("InfractorBundle:Coches:formulario.html.twig", array("form" => $form->createView()));
        else
        {
            $form->bind($request);
            $coche->setCredencial($credencial);
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
                    return $this->render("InfractorBundle:Coches:formulario.html.twig", array("form" => $form->createView()));

                $em = $this->getDoctrine()->getManager();
                $em->persist($coche);
                $em->flush();

                $objMatricula = new Matriculas();
                $objMatricula->setCoche($coche);
                $objMatricula->setMatricula($nuevaMatricula);
                $em->persist($objMatricula);
                $em->flush();

                return $this->redirect($this->generateUrl("get_home"));
            }

            return $this->render("InfractorBundle:Coches:formulario.html.twig", array("form" => $form->createView()));
        }
    }
}
