<?php

namespace InfractorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\Length;

// En este controlador se controlará el login del conductor infractor

class LoginController extends Controller
{
    public function getLoginAction()
    {
        $request = $this->getRequest();
        $form = $this->createFormBuilder(null, array())
                ->add("credencial", "text")
                ->add("password", "password", [ "constraints" => new Length(["min" => 5, "minMessage" => "La contraseña tiene que tener 5 caracteres mínimo"]) ])
                ->getForm();

        if ($request->getMethod() == "GET")  // SI ES GET
        {
            return $this->render('InfractorBundle:Login:login.html.twig', array(
                "form" => $form->createView()
            ));
        }
        else // SI ES POST
        {
            // Obtenemos las cosas del formulario "login.html.twig" y las procesamos like a baus
            $form->bind($request);
            if ($form->isSubmitted() && $form->isValid())
            {
                $credencial = $form->get("credencial")->getData();
                $password = $form->get("password")->getData();

                // Ahora llamamos a la base de datos para comprobar si el usuario y contraseña son reales :)

                $em = $this->getDoctrine()->getManager();
                $usuario = $em->getRepository("DBBundle:Infractor")->find($credencial);

                $error = false;
                if (!$usuario)
                    $error = true;

                if (!$error && $usuario->getPassword() != $password)
                    $error = true;

                if ($error)
                {
                    $this->get("session")->getFlashBag()->add(
                        "error",
                        "No se ha podido iniciar sesión con los datos provistos"
                    );

                    return $this->render('InfractorBundle:Login:login.html.twig', array(
                        "form" => $form->createView()
                    ));
                }

                $session = $this->get("session");
                $session->set("credencial", $credencial);
                $session->set("usuario", $usuario);
                return $this->redirect($this->generateUrl("get_home"));
            }

            return $this->render('InfractorBundle:Login:login.html.twig', array(
                "form" => $form->createView()
            ));
        }
    }

    public function doLogoutAction() 
    {
        $session = $this->get("session");
        $session->clear();

        return $this->redirect($this->generateUrl("get_login"));
    }

    public function registerAction()
    {
        // Registramos al user mediante formulario

        $request = $this->getRequest();

        $infractor = new Infractor();
        $form = $this->createForm(new InfractorType(), $infractor);

        if ($request->getMethod() == "GET") //obtener la page
        {
            return $this->render('InfractorBundle:Login:register.html.twig');
        }
        else                                //registrar al notas
        {
            $form->bind($request);

            if ($form->isSubmitted() && $form->isValid()) //validar formulario
            {
                //Validar datos...

                $errores = $this->get("validator")->validate($infractor);

                if(sizeof($errores) > 0)
                {
                    $session = $this->get("session");
                    $session->getFlashBag()->add("error", $error);
                }

                //... y persistir
                $em = $this->getDoctrine()->getManager();
                $em->getRepository("DBBundle:Infractor")->persist();
            }
        }
    }
}
