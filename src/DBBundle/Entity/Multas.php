<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     *  @Assert\Regex(
     *     pattern="/[0-9]*$/",
     *     message="El precio tiene que ser un entero, y no puede tener letras"
     * )
     * @Assert\GreaterThan(
     *      value="0",
     *      message="El precio tiene que ser mayor que 0"
     * )
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \Matriculas
     *
     * @ORM\ManyToOne(targetEntity="Matriculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matricula", referencedColumnName="matricula")
     * })
     */
    private $matricula;

    /**
     * @var \Infractor
     *
     * @ORM\ManyToOne(targetEntity="Infractor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="credencial", referencedColumnName="credencial")
     * })
     */
    private $credencial;

    /**
     * @var \Admins
     *
     * @ORM\ManyToOne(targetEntity="Admins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="admin", referencedColumnName="credencial_admin")
     * })
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
     * @param \DBBundle\Entity\Matriculas $matricula
     *
     * @return Multas
     */
    public function setMatricula(\DBBundle\Entity\Matriculas $matricula = null)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return \DBBundle\Entity\Matriculas
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set credencial
     *
     * @param \DBBundle\Entity\Infractor $credencial
     *
     * @return Multas
     */
    public function setCredencial(\DBBundle\Entity\Infractor $credencial = null)
    {
        $this->credencial = $credencial;

        return $this;
    }

    /**
     * Get credencial
     *
     * @return \DBBundle\Entity\Infractor
     */
    public function getCredencial()
    {
        return $this->credencial;
    }

    /**
     * Set admin
     *
     * @param \DBBundle\Entity\Admins $admin
     *
     * @return Multas
     */
    public function setAdmin(\DBBundle\Entity\Admins $admin = null)
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \DBBundle\Entity\Admins
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    public function validateMatricula($matricula)
    {
        if (preg_match("/[[:digit:]]{4} [[:alpha:]]{3}$/", $matricula) != 1 &&
            preg_match("/[[:alpha:]]{1} [[:digit:]]{4} [[:alpha:]]{2}$/", $matricula) != 1 &&
            preg_match("/[[:alpha:]]{2} [[:digit:]]{4} [[:alpha:]]{1}$/", $matricula) != 1)
            return false;

        return true;
    }
}
