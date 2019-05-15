<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Coches
 *
 * @ORM\Table(name="coches", indexes={@ORM\Index(name="credencial", columns={"credencial"})})
 * @ORM\Entity
 */
class Coches
{
    /**
     * @var string
     *
     * @ORM\Column(name="n_bastidor", type="string", length=50, nullable=false)
     * @ORM\Id
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="El número de bastidor no puede contener letras"
     * )
     */
    private $nBastidor;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     * @Assert\Regex(
     *     pattern="/^[0-9]{4,4}$/",
     *     message="El año debe ser un número de 4 cifras"
     * )
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     * @Assert\Regex(
     *     pattern="/^[A-Za-z ñ]+$/",
     *     message="El color no puede contener números"
     * )
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(name="potencia_cv", type="integer", nullable=false)
     * @Assert\Length(
     *     min=2,
     *     max=4,
     *     minMessage="La potencia debe de estar entre 10 y 9999 caballos",
     *     maxMessage="La potencia debe de estar entre 10 y 9999 caballos"
     * )
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="La potencia no puede contener letras"
     * )
     */
    private $potenciaCv;

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
     * Get nBastidor
     *
     * @return string
     */
    public function getNBastidor()
    {
        return $this->nBastidor;
    }

    /**
     * Set nBastidor
     *
     * @return Coches
     */
    public function setNBastidor($nBastidor)
    {
        $this->nBastidor = $nBastidor;

        return $this;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Coches
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Coches
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set potenciaCv
     *
     * @param integer $potenciaCv
     *
     * @return Coches
     */
    public function setPotenciaCv($potenciaCv)
    {
        $this->potenciaCv = $potenciaCv;

        return $this;
    }

    /**
     * Get potenciaCv
     *
     * @return integer
     */
    public function getPotenciaCv()
    {
        return $this->potenciaCv;
    }

    /**
     * Set credencial
     *
     * @param \DBBundle\Entity\Infractor $credencial
     *
     * @return Coches
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

    public function validateMatricula($matricula)
    {
        if (preg_match("/[[:digit:]]{4} [[:alpha:]]{3}/", $matricula) != 1 &&
            preg_match("/[[:alpha:]]{1} [[:digit:]]{4} [[:alpha:]]{2}/", $matricula) != 1 &&
            preg_match("/[[:alpha:]]{2} [[:digit:]]{4} [[:alpha:]]{1}/", $matricula) != 1)
            return false;

        return true;
    }
}
