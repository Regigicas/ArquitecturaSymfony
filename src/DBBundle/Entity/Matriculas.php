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
     * @ORM\Column(name="n_bastidor", type="string", length=50, nullable=false)
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
     * @param string
     *
     * @return string
     */
    public function setNBastidor($NBastidor)
    {
        $this->NBastidor = $NBastidor;

        return $this;
    }

    /**
     * Get NBastidor
     *
     * @return string
     */
    public function getNBastidor()
    {
        return $this->NBastidor;
    }
}
