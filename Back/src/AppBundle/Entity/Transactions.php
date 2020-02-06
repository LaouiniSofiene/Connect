<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transactions
 *
 * @ORM\Table(name="transactions", indexes={@ORM\Index(name="FK_Client", columns={"idClient"}), @ORM\Index(name="FK_Employee", columns={"idEmployee"}), @ORM\Index(name="Fk_Etablissement", columns={"idetab"})})
 * @ORM\Entity
 */
class Transactions
{
    public function __construct()
    {
        $this->date = new \DateTime();
    }
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
     * @var \AppBundle\Entity\Establishment
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Establishment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idetab", referencedColumnName="Id")
     * })
     */
    private $idetab;


    /**
     * @var string
     *
     * @ORM\Column(name="Qrstring", type="string", length=255, nullable=true)
     */
    private $qrString;

    /**
     * Set qrstring
     *
     * @param string $qrstring
     *
     * @return Accounts
     */
     
    public function setQrstring($qrString)
    {
        $this->qrString = $qrString;

        return $this;
    }

    /**
     * Get qrstring
     *
     * @return integer
     */
    public function getQrstring()
    {
        return $this->qrString;
    }

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

    /**
     * Set idetab
     *
     * @param \AppBundle\Entity\Establishment $idetab
     *
     * @return Transactions
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
