<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accounts
 *
 * @ORM\Table(name="accounts", indexes={@ORM\Index(name="fk_e", columns={"idetab"})})
 * @ORM\Entity
 */
class Accounts
{
    public function __construct($period = 1)
    {

        $this->numberIn = 0;
        $this->receivingdate = new \DateTime();
        $this->expirationdate = new \DateTime();
        $this->expirationdate->setDate($this->expirationdate->format('Y'), $this->expirationdate->format('m')+$period, $this->expirationdate->format('d'));

    }
    /**
     * @var integer
     *
     * @ORM\Column(name="Amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="QrString", type="string", length=500, nullable=false)
     */
    private $qrstring;

    /**
     * @var integer
     *
     * @ORM\Column(name="NumberAccess", type="integer", nullable=false)
     */
    private $numberaccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="numberIn", type="integer", nullable=true)
     */
    private $numberin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ExpirationDate", type="datetime", nullable=false)
     */
    private $expirationdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ReceivingDate", type="datetime", nullable=false)
     */
    private $receivingdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
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
     * @var \AppBundle\Entity\Clients
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdClient", referencedColumnName="id")
     * })
     */
    private $idclient;

    /**
     * Set idclient
     *
     * @param \AppBundle\Entity\Clients $idclient
     *
     * @return Clients
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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Accounts
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
     * Set qrstring
     *
     * @param string $qrstring
     *
     * @return Accounts
     */
    public function setQrstring($qrstring)
    {
        $this->qrstring = $qrstring;

        return $this;
    }

    /**
     * Get qrstring
     *
     * @return string
     */
    public function getQrstring()
    {
        return $this->qrstring;
    }
    /**
     * Set numberin
     *
     * @param integer $numberaccess
     *
     * @return Accounts
     */
    public function setNumberin($numberin)
    {
        $this->numberin = $numberin;

        return $this;
    }

    /**
     * Get numberin
     *
     * @return integer
     */
    public function getNumberin()
    {
        return $this->numberin;
    }
    /**
     * Set numberaccess
     *
     * @param integer $numberaccess
     *
     * @return Accounts
     */
    public function setNumberaccess($numberaccess)
    {
        $this->numberaccess = $numberaccess;

        return $this;
    }

    /**
     * Get numberaccess
     *
     * @return integer
     */
    public function getNumberaccess()
    {
        return $this->numberaccess;
    }

    /**
     * Set expirationdate
     *
     * @param \DateTime $expirationdate
     *
     * @return Accounts
     */
    public function setExpirationdate($expirationdate)
    {
        $this->expirationdate = $expirationdate;

        return $this;
    }

    /**
     * Get expirationdate
     *
     * @return \DateTime
     */
    public function getExpirationdate()
    {
        return $this->expirationdate;
    }

    /**
     * Set receivingdate
     *
     * @param \DateTime $receivingdate
     *
     * @return Accounts
     */
    public function setReceivingdate($receivingdate)
    {
        $this->receivingdate = $receivingdate;

        return $this;
    }

    /**
     * Get receivingdate
     *
     * @return \DateTime
     */
    public function getReceivingdate()
    {
        return $this->receivingdate;
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
     * @return Accounts
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
    public function __toString()
    {
        return $this->getQrstring();
    }
}
