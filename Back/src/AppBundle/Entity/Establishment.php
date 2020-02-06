<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Establishment
 *
 * @ORM\Table(name="establishment", indexes={@ORM\Index(name="fk_fos", columns={"idFos"})})
 * @ORM\Entity
 */
class Establishment
{
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=500, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\FosUser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFos", referencedColumnName="id")
     * })
     */
    private $idfos;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Establishment
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set idfos
     *
     * @param \AppBundle\Entity\FosUser $idfos
     *
     * @return Establishment
     */
    public function setIdfos(\AppBundle\Entity\FosUser $idfos = null)
    {
        $this->idfos = $idfos;

        return $this;
    }

    /**
     * Get idfos
     *
     * @return \AppBundle\Entity\FosUser
     */
    public function getIdfos()
    {
        return $this->idfos;
    }
}
