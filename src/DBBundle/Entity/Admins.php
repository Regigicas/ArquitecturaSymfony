<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Admins
 *
 * @ORM\Table(name="admins")
 * @ORM\Entity
 */
class Admins
{
    /**
     * @var string
     *
     * @ORM\Column(name="credencial_admin", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $credencialAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="password_admin", type="string", length=255, nullable=false)
     * @Assert\Length(
     *     min=5,
     *     minMessage="La contraseña tiene un mínimo de 5 caracteres"
     * )
     */
    private $passwordAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_admin", type="string", length=255, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z ñ]+$/",
     *     message="El nombre no pueden contener números"
     * )
     */
    private $nombreAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos_admin", type="string", length=255, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z ñ]+$/",
     *     message="Los apellidos no pueden contener números"
     * )
     */
    private $apellidosAdmin;



    /**
     * Get credencialAdmin
     *
     * @return string
     */
    public function getCredencialAdmin()
    {
        return $this->credencialAdmin;
    }

    /**
     * Set passwordAdmin
     *
     * @param string $passwordAdmin
     *
     * @return Admins
     */
    public function setPasswordAdmin($passwordAdmin)
    {
        $this->passwordAdmin = $passwordAdmin;

        return $this;
    }

    /**
     * Get passwordAdmin
     *
     * @return string
     */
    public function getPasswordAdmin()
    {
        return $this->passwordAdmin;
    }

    /**
     * Set nombreAdmin
     *
     * @param string $nombreAdmin
     *
     * @return Admins
     */
    public function setNombreAdmin($nombreAdmin)
    {
        $this->nombreAdmin = $nombreAdmin;

        return $this;
    }

    /**
     * Get nombreAdmin
     *
     * @return string
     */
    public function getNombreAdmin()
    {
        return $this->nombreAdmin;
    }

    /**
     * Set apellidosAdmin
     *
     * @param string $apellidosAdmin
     *
     * @return Admins
     */
    public function setApellidosAdmin($apellidosAdmin)
    {
        $this->apellidosAdmin = $apellidosAdmin;

        return $this;
    }

    /**
     * Get apellidosAdmin
     *
     * @return string
     */
    public function getApellidosAdmin()
    {
        return $this->apellidosAdmin;
    }

    public function __toString()
    {
        return (string)$this->credencial;
    }
}
