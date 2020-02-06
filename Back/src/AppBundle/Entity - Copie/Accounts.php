<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Datetime;
/**
 * Accounts
 *
 * @ORM\Table(name="accounts")
 * @ORM\Entity
 */
class Accounts
{
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

    function __construct() {
        $employee->giveaccess=0;
        $employee->payment=0;
        $employee->transfert=0;
        $employee->verifyaccess=0;
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
}
