<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Length;

class LoginController extends Controller
{

    public function doLoginAction()
    {
        $request = $this->getRequest();
        $form = $this->createFormBuilder(null, array())
                ->add("credencial", "text")
                ->add("password", "password", [ "constraints" => new Length(["min" => 5, "minMessage" => "La contraseña tiene que tener 5 caracteres mínimo"]) ])
                ->getForm();

        if ($request->getMethod() == "GET")
            return $this->render('AdminBundle:Login:login.html.twig', array( "form" => $form->createView()));
        else
        {
            // Obtenemos las cosas del formulario "login.html.twig" y las procesamos like a baus

            $form->bind($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $credencial = $form->get("credencial")->getData();
                $password = $form->get("password")->getData();

                // Ahora llamamos a la base de datos para comprobar si el usuario y contraseña son reales :)

                $em = $this->getDoctrine()->getManager();
                $usuario = $em->getRepository("DBBundle:Admins")->find($credencial);

                $error = false;
                if (!$usuario)
                    $error = true;

                if (!$error && $usuario->getPasswordAdmin() != $password)
                    $error = true;

                if ($error)
                {
                    $this->get("session")->getFlashBag()->add(
                        "error",
                        "No se ha podido iniciar sesión con los datos provistos"
                    );

                    return $this->render('Adminbundle:Login:login.html.twig', array( "form" => $form->createView() ));
                }

                $session = $this->get("session");
                $session->set("credencial", $credencial);
                $session->set("usuario", $usuario);
                return $this->redirect($this->generateUrl("get_home_admin"));
            }

            return $this->render('AdminBundle:Login:login.html.twig', array( "form" => $form->createView() ));
        }
    }

    public function logoutAction()
    {
        $session = $this->get("session");
        $session->clear();

        return $this->redirect($this->generateUrl("get_login_admin"));
    }
}
