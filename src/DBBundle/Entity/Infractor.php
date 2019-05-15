<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Infractor
 *
 * @ORM\Table(name="infractor")
 * @ORM\Entity
 */
class Infractor
{
    /**
     * @var string
     *
     * @ORM\Column(name="credencial", type="string", length=255, nullable=false)
     * @ORM\Id
     * @Assert\Regex(
     *     pattern="/[0-9]{8}[A-Z]{1}/",
     *     message="El credencial (DNI) debe tener 8 números seguidos de una letra en mayúscula"
     * )
     */
    private $credencial;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z ñ]+$/",
     *     message="El nombre no pueden contener números"
     * )
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z ñ]+$/",
     *     message="Los apellidos no pueden contener números"
     * )
     */
    private $apellidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="tlf", type="integer", nullable=false)
     * @Assert\Regex(
     *     pattern="/[6-7]{1}[0-9]{8}/",
     *     message="El teléfono sólo pueden ser 9 números, empezando por 6 o 7"
     * )
     */
    private $tlf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="f_exp_carnet", type="date", nullable=false)
     */
    private $fExpCarnet;

    /**
     * Set credencial
     *
     * @return Infractor
     */
    public function setCredencial($credencial)
    {
        $this->credencial = $credencial;

        return $this;
    }


    /**
     * Get credencial
     *
     * @return string
     */
    public function getCredencial()
    {
        return $this->credencial;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Infractor
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Infractor
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Infractor
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set tlf
     *
     * @param integer $tlf
     *
     * @return Infractor
     */
    public function setTlf($tlf)
    {
        $this->tlf = $tlf;

        return $this;
    }

    /**
     * Get tlf
     *
     * @return integer
     */
    public function getTlf()
    {
        return $this->tlf;
    }

    /**
     * Set fExpCarnet
     *
     * @param \DateTime $fExpCarnet
     *
     * @return Infractor
     */
    public function setFExpCarnet($fExpCarnet)
    {
        $this->fExpCarnet = $fExpCarnet;

        return $this;
    }

    /**
     * Get fExpCarnet
     *
     * @return \DateTime
     */
    public function getFExpCarnet()
    {
        return $this->fExpCarnet;
    }

    public function __toString()
    {
        return (string)$this->credencial;
    }
}
