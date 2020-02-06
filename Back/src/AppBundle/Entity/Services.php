<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Services
 *
 * @ORM\Table(name="services", indexes={@ORM\Index(name="fk_Etab", columns={"idetab"})})
 * @ORM\Entity
 */
class Services
{
    /**
     * @var string
     *
     * @ORM\Column(name="Lable", type="string", length=255, nullable=false)
     */
    private $lable;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Establishment
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Establishment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idetab", referencedColumnName="Id")
     * })
     */
    private $idetab;



    /**
     * Set lable
     *
     * @param string $lable
     *
     * @return Services
     */
    public function setLable($lable)
    {
        $this->lable = $lable;

        return $this;
    }

    /**
     * Get lable
     *
     * @return string
     */
    public function getLable()
    {
        return $this->lable;
    }

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
     * Set idetab
     *
     * @param \AppBundle\Entity\Establishment $idetab
     *
     * @return Services
     */
    public function setIdetab(\AppBundle\Entity\Establishment $idetab = null)
    {
        $this->idetab = $idetab;

        return $this;
    }

    /**
     * Get idetab
     *
     * @return \AppBundle\Entity\Establishment
     */
    public function getIdetab()
    {
        return $this->idetab;
    }
}
