<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oauth2Clients
 *
 * @ORM\Table(name="oauth2_clients")
 * @ORM\Entity
 */
class Oauth2Clients
{
    /**
     * @var string
     *
     * @ORM\Column(name="random_id", type="string", length=255, nullable=false)
     */
    private $randomId;

    /**
     * @var array
     *
     * @ORM\Column(name="redirect_uris", type="array", nullable=false)
     */
    private $redirectUris;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=255, nullable=false)
     */
    private $secret;

    /**
     * @var array
     *
     * @ORM\Column(name="allowed_grant_types", type="array", nullable=false)
     */
    private $allowedGrantTypes;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set randomId
     *
     * @param string $randomId
     *
     * @return Oauth2Clients
     */
    public function setRandomId($randomId)
    {
        $this->randomId = $randomId;

        return $this;
    }

    /**
     * Get randomId
     *
     * @return string
     */
    public function getRandomId()
    {
        return $this->randomId;
    }

    /**
     * Set redirectUris
     *
     * @param array $redirectUris
     *
     * @return Oauth2Clients
     */
    public function setRedirectUris($redirectUris)
    {
        $this->redirectUris = $redirectUris;

        return $this;
    }

    /**
     * Get redirectUris
     *
     * @return array
     */
    public function getRedirectUris()
    {
        return $this->redirectUris;
    }

    /**
     * Set secret
     *
     * @param string $secret
     *
     * @return Oauth2Clients
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set allowedGrantTypes
     *
     * @param array $allowedGrantTypes
     *
     * @return Oauth2Clients
     */
    public function setAllowedGrantTypes($allowedGrantTypes)
    {
        $this->allowedGrantTypes = $allowedGrantTypes;

        return $this;
    }

    /**
     * Get allowedGrantTypes
     *
     * @return array
     */
    public function getAllowedGrantTypes()
    {
        return $this->allowedGrantTypes;
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
