<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="clients", indexes={@ORM\Index(name="Fk_Account", columns={"Id_Account"}), @ORM\Index(name="IDX_C82E74B93A24E9", columns={"idFos"})})
 * @ORM\Entity
 */
class Clients
{
    /**
     * @var string
     *
     * @ORM\Column(name="Last_Name", type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="First_Name", type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="Cin", type="string", length=100, nullable=true)
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="Passport", type="string", length=100, nullable=true)
     */
    private $passport;

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
     * @var \AppBundle\Entity\Accounts
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Accounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_Account", referencedColumnName="id")
     * })
     */
    private $idAccount;



    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Clients
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Clients
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
     * Set cin
     *
     * @param string $cin
     *
     * @return Clients
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
     * Set passport
     *
     * @param string $passport
     *
     * @return Clients
     */
    public function setPassport($passport)
    {
        $this->passport = $passport;

        return $this;
    }

    /**
     * Get passport
     *
     * @return string
     */
    public function getPassport()
    {
        return $this->passport;
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
     * @return Clients
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
     * Set idAccount
     *
     * @param \AppBundle\Entity\Accounts $idAccount
     *
     * @return Clients
     */
    public function setIdAccount(\AppBundle\Entity\Accounts $idAccount = null)
    {
        $this->idAccount = $idAccount;

        return $this;
    }

    /**
     * Get idAccount
     *
     * @return \AppBundle\Entity\Accounts
     */
    public function getIdAccount()
    {
        return $this->idAccount;
    }
}
