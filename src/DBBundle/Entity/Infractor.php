<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255, nullable=false)
     */
    private $apellidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="tlf", type="integer", nullable=false)
     */
    private $tlf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="f_exp_carnet", type="date", nullable=false)
     */
    private $fExpCarnet;



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

    /**
     *  @ORM\OneToMany (targetEntity="Multas", mappedBy="multas")
     */
    private $multas;

    public function __construct()
    {
        $this->multas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addMultas(Multas $multas)
    {
        $this->multas[] = $multas;
    }

    public function getMultas()
    {
        return $this->multas;
    }
}
