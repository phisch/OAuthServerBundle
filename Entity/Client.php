<?php

namespace Phisch\OAuthServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use OAuth2ServerBundle\Generator\Random;

/**
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="OAuth2ServerBundle\Repository\ClientRepository")
 * @ORM\EntityListeners({})
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
     * @var string
     *
     * @ORM\Column(type="string", length=2000, nullable=true)
     */
    private $redirectUri;

    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=true)
     */
    private $grantTypes = [];

    public function __construct()
    {
        // TODO: solve this via doctrine listeners!
        $this->setClientId(Random::generateString());
        $this->setSecret(Random::generateString());
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * proxy for getClientId because of the interface
     * @return string
     */
    public function getName()
    {
        // TODO: check if this is really the name
        return $this->getClientId();
    }

    /**
     * @return int
     */
    public function getIdentifier()
    {
        return $this->getClientId();
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
     * @param $grantType
     */
    public function addGrantType($grantType)
    {
        $this->grantTypes[] = $grantType;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }
}

