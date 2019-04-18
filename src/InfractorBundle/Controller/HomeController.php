<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

// Este controlador actuará para ir a la home del infractor y conseguir los datos de la base de datos que se le mostrarán en la pantalla principal

class HomeController extends Controller
{
    public function getHomeAction()
    {
        // Obtenemos todas las multas del infractor y las pasamos al twig dentro del array
        
        $credencial = $this->get("session")->get("credencial");
        if (!$credencial)
            throw new AccessDeniedHttpException();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
                            ->select("m.id", "m.razon", "m.fecha", "m.reclamada", "m.precio", "m.estado", "t.matricula", "m.direccion")
                            ->from("DBBundle:Multas", "m")
                            ->leftJoin("DBBundle:Matriculas", "t", \Doctrine\ORM\Query\Expr\Join::WITH, "m.matricula = t.matricula")
                            ->leftJoin("DBBundle:Coches", "c", \Doctrine\ORM\Query\Expr\Join::WITH, "t.NBastidor = c.NBastidor")
                            ->where("c.credencial = :credencial")
                            ->setParameter(":credencial", $credencial)
                            ->getQuery();

        $multas = $query->getResult();
        
        return $this->render('InfractorBundle:Home:home.html.twig', array("multas" => $multas));
    }

    public function detallesMultaAction()
    {
        $request = $this->getRequest();
        if ($request->getMethod() != "POST")
            return $this->redirect($this->generateUrl("get_home"));

        // Se obtiene la multa que se le va a pasar
        
        $multaId = $request->get("multa");
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQueryBuilder()
                            ->select("m.fecha", "m.razon", "m.reclamada", "m.direccion", "m.precio", "m.estado",
                                     "m.matricula", "a.nombreAdmin", "m.credencial")
                            ->from("DBBundle:Multas", "m")
                            ->leftJoin("DBBundle:Admins", "a", \Doctrine\ORM\Query\Expr\Join::WITH, "m.admin = a.credencialAdmin")
                            ->where("m.id = :id")
                            ->setParameter(":id", $multaId)
                            ->getQuery();

        $multa = $query->getResult();

        $this->get("session")->set("idMulta", $multaId);

        // Render de la multa
        return $this->render('InfractorBundle:DetallesMulta:detallesMulta.html.twig', array("multa" => $multa[0]));
    }

    public function getHomeReclamarAction()
    {
        // Se muestra un mensaje de "reclamada" y se redirige a home
        $idMulta = $this->get("session")->get("idMulta");
        $em = $this->getDoctrine()->getManager();
        $multa = $em->getRepository("DBBundle:Multas")->find($idMulta);
        if (!$multa)
            throw new NotFoundHttpException("No se encuentra la multa con el id $idMulta!");
        
        $multa->setReclamada(1);
        $em->flush();

        // Redirigir a home
        return $this->redirect($this->generateUrl('get_home'));
    }
}
