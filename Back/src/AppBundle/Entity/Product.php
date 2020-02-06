<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="fk_Etabliss", columns={"idetab"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="Price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="Qt", type="integer", nullable=false)
     */
    private $qt;

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
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set qt
     *
     * @param integer $qt
     *
     * @return Product
     */
    public function setQt($qt)
    {
        $this->qt = $qt;

        return $this;
    }

    /**
     * Get qt
     *
     * @return integer
     */
    public function getQt()
    {
        return $this->qt;
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
     * @return Product
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
