<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $nBastidor;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=50, nullable=false)
     */
    private $color;

    /**
     * @var integer
     *
     * @ORM\Column(name="potencia_cv", type="integer", nullable=false)
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

    /**
     *  @ORM\OneToMany (targetEntity="Matriculas", mappedBy="matriculas")
     */
    private $matriculas;

    public function __construct()
    {
        $this->matriculas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addMatriculas(Matriculas $multas)
    {
        $this->matriculas[] = $matriculas;
    }

    public function getMatriculas()
    {
        return $this->matriculas;
    }
}
