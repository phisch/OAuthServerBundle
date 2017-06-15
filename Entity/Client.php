<?php

namespace Phisch\OAuthServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Phisch\OAuth\Server\Entity\ClientEntityInterface;

/**
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="Phisch\OAuthServerBundle\Repository\ClientRepository")
 * @ORM\EntityListeners({"Phisch\OAuthServerBundle\Entity\Listener\ClientListener"})
 */
class Client implements ClientEntityInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $secret;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $redirectUris = [];

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $grantTypes = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return array
     */
    public function getGrantTypes()
    {
        return $this->grantTypes;
    }

    /**
     * @param array $grantTypes
     */
    public function setGrantTypes($grantTypes)
    {
        $this->grantTypes = $grantTypes;
    }

    /**
     * @return array
     */
    public function getRedirectUris()
    {
        return $this->redirectUris;
    }

    /**
     * @param array $redirectUris
     */
    public function setRedirectUris($redirectUris)
    {
        $this->redirectUris = $redirectUris;
    }
}
