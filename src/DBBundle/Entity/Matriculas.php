<?php

namespace DBBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matriculas
 *
 * @ORM\Table(name="matriculas", indexes={@ORM\Index(name="n_bastidor", columns={"n_bastidor"})})
 * @ORM\Entity
 */
class Matriculas
{
    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=50, nullable=false)
     * @ORM\Id
     */
    private $matricula;

    /**
     * @var \Coches
     *
     * @ORM\ManyToOne(targetEntity="Coches")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="n_bastidor", referencedColumnName="n_bastidor")
     * })
     */
    private $NBastidor;

    /**
     * Set matricula
     *
     * @param string
     *
     * @return string
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
     * Set NBastidor
     *
     * @param \DBBundle\Entity\Coches $NBastidor
     *
     * @return Matriculas
     */
    public function setNBastidor(\DBBundle\Entity\Coches $NBastidor = null)
    {
        $this->NBastidor = $NBastidor;

        return $this;
    }

    /**
     * Get NBastidor
     *
     * @return \DBBundle\Entity\Coches
     */
    public function getNBastidor()
    {
        return $this->NBastidor;
    }

    public function __toString()
    {
        return (string)$this->matricula;
    }
}
