<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transactions
 *
 * @ORM\Table(name="transactions", indexes={@ORM\Index(name="FK_Client", columns={"idClient"}), @ORM\Index(name="FK_Employee", columns={"idEmployee"})})
 * @ORM\Entity
 */
class Transactions
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Clients
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idClient", referencedColumnName="id")
     * })
     */
    private $idclient;

    /**
     * @var \AppBundle\Entity\Employees
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEmployee", referencedColumnName="id")
     * })
     */
    private $idemployee;



    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transactions
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Transactions
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
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
     * Set idclient
     *
     * @param \AppBundle\Entity\Clients $idclient
     *
     * @return Transactions
     */
    public function setIdclient(\AppBundle\Entity\Clients $idclient = null)
    {
        $this->idclient = $idclient;

        return $this;
    }

    /**
     * Get idclient
     *
     * @return \AppBundle\Entity\Clients
     */
    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * Set idemployee
     *
     * @param \AppBundle\Entity\Employees $idemployee
     *
     * @return Transactions
     */
    public function setIdemployee(\AppBundle\Entity\Employees $idemployee = null)
    {
        $this->idemployee = $idemployee;

        return $this;
    }

    /**
     * Get idemployee
     *
     * @return \AppBundle\Entity\Employees
     */
    public function getIdemployee()
    {
        return $this->idemployee;
    }
}
