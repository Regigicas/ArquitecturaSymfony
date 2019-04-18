<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Multas
 *
 * @ORM\Table(name="multas", indexes={@ORM\Index(name="matricula", columns={"matricula"}), @ORM\Index(name="credencial", columns={"credencial"}), @ORM\Index(name="multas_ibfk_3", columns={"admin"})})
 * @ORM\Entity
 */
class Multas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="razon", type="string", length=255, nullable=false)
     */
    private $razon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="reclamada", type="boolean", nullable=false)
     */
    private $reclamada = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", precision=10, scale=0, nullable=false)
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=255, nullable=false)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="credencial", type="string", length=255, nullable=false)
     */
    private $credencial;

    /**
     * @var string
     *
     * @ORM\Column(name="admin", type="string", length=255, nullable=false)
     */
    private $admin;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set razon
     *
     * @param string $razon
     *
     * @return Multas
     */
    public function setRazon($razon)
    {
        $this->razon = $razon;

        return $this;
    }

    /**
     * Get razon
     *
     * @return string
     */
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Multas
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set reclamada
     *
     * @param boolean $reclamada
     *
     * @return Multas
     */
    public function setReclamada($reclamada)
    {
        $this->reclamada = $reclamada;

        return $this;
    }

    /**
     * Get reclamada
     *
     * @return boolean
     */
    public function getReclamada()
    {
        return $this->reclamada;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Multas
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set precio
     *
     * @param float $precio
     *
     * @return Multas
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Multas
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set matricula
     *
     * @param string $matricula
     *
     * @return Multas
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set credencial
     *
     * @param string
     *
     * @return Multas
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
     * Set admin
     *
     * @param string
     *
     * @return Multas
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return string
     */
    public function getAdmin()
    {
        return $this->admin;
    }
}
