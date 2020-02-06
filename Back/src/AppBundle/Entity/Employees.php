<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employees
 *
 * @ORM\Table(name="employees", indexes={@ORM\Index(name="FK_Services", columns={"IdService"}), @ORM\Index(name="IDX_BA82C300B93A24E9", columns={"idFos"}), @ORM\Index(name="Fk_Etablis", columns={"idetab"})})
 * @ORM\Entity
 */
class Employees
{   
    function __construct() {
        $this->giveaccess=0;
        $this->payment=0;
        $this->transfert=0;
        $this->verifyaccess=0;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="First_Name", type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="Last_Name", type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="Cin", type="string", length=255, nullable=false)
     */
    private $cin;

    /**
     * @var integer
     *
     * @ORM\Column(name="GiveAccess", type="integer", nullable=false)
     */
    private $giveaccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="Payment", type="integer", nullable=false)
     */
    private $payment;

    /**
     * @var integer
     *
     * @ORM\Column(name="Transfert", type="integer", nullable=false)
     */
    private $transfert;

    /**
     * @var integer
     *
     * @ORM\Column(name="VerifyAccess", type="integer", nullable=false)
     */
    private $verifyaccess;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
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
     * @var \AppBundle\Entity\Services
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdService", referencedColumnName="Id")
     * })
     */
    private $idservice;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employees
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Employees
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set cin
     *
     * @param string $cin
     *
     * @return Employees
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set giveaccess
     *
     * @param integer $giveaccess
     *
     * @return Employees
     */
    public function setGiveaccess($giveaccess)
    {
        $this->giveaccess = $giveaccess;

        return $this;
    }

    /**
     * Get giveaccess
     *
     * @return integer
     */
    public function getGiveaccess()
    {
        return $this->giveaccess;
    }

    /**
     * Set payment
     *
     * @param integer $payment
     *
     * @return Employees
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return integer
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set transfert
     *
     * @param integer $transfert
     *
     * @return Employees
     */
    public function setTransfert($transfert)
    {
        $this->transfert = $transfert;

        return $this;
    }

    /**
     * Get transfert
     *
     * @return integer
     */
    public function getTransfert()
    {
        return $this->transfert;
    }

    /**
     * Set verifyaccess
     *
     * @param integer $verifyaccess
     *
     * @return Employees
     */
    public function setVerifyaccess($verifyaccess)
    {
        $this->verifyaccess = $verifyaccess;

        return $this;
    }

    /**
     * Get verifyaccess
     *
     * @return integer
     */
    public function getVerifyaccess()
    {
        return $this->verifyaccess;
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
     * @return Employees
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

    /**
     * Set idservice
     *
     * @param \AppBundle\Entity\Services $idservice
     *
     * @return Employees
     */
    public function setIdservice(\AppBundle\Entity\Services $idservice = null)
    {
        $this->idservice = $idservice;

        return $this;
    }

    /**
     * Get idservice
     *
     * @return \AppBundle\Entity\Services
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    /**
     * Set idetab
     *
     * @param \AppBundle\Entity\Establishment $idetab
     *
     * @return Employees
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
        return $this->getFirstName();
    }
}
