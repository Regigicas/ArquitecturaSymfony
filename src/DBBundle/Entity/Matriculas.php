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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
    private $nBastidor;



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
     * Set nBastidor
     *
     * @param \DBBundle\Entity\Coches $nBastidor
     *
     * @return Matriculas
     */
    public function setNBastidor(\DBBundle\Entity\Coches $nBastidor = null)
    {
        $this->nBastidor = $nBastidor;

        return $this;
    }

    /**
     * Get nBastidor
     *
     * @return \DBBundle\Entity\Coches
     */
    public function getNBastidor()
    {
        return $this->nBastidor;
    }
}
