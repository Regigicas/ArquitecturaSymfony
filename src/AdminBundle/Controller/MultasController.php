<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        if($request->getMethod() == "GET")
        {
            $this->render('AdminBundle:Multa:newMulta.html.twig', array( "form" => $form->createView() ));
        }
        else
        {
            //Posteo de la multa, tras validar tanto formulario como campos


        }

    }
}
