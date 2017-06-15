<?php

namespace Phisch\OAuthServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Phisch\OAuth\Server\Entity\AccessTokenEntityInterface;
use Phisch\OAuth\Server\Entity\ClientEntityInterface;
use Phisch\OAuth\Server\Entity\ScopeEntityInterface;

/**
 * @ORM\Table(name="access_token")
 * @ORM\Entity(repositoryClass="Phisch\OAuthServerBundle\Repository\AccessTokenRepository")
 */
class AccessToken
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $identifier;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="Phisch\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @var Scope[]
     * @ORM\ManyToMany(targetEntity="Phisch\OAuthServerBundle\Entity\Scope")
     * @ORM\JoinTable(name="access_token_scope", joinColumns={@ORM\JoinColumn(name="access_token_id", referencedColumnName="id")})
     */
    protected $scopes;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $expires;

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
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getExpiryDateTime()
    {
        return $this->expires;
    }

    public function setExpiryDateTime(\DateTime $dateTime)
    {
        $this->expires = $dateTime;
    }

    public function setUserIdentifier($identifier)
    {
        $this->user = $identifier;
    }

    public function getUserIdentifier()
    {
        return $this->user;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(ClientEntityInterface $client)
    {
        $this->client = $client;
    }

    public function addScope(ClientEntityInterface $scope)
    {
        $this->scopes[] = $scope;
    }

    /**
     * @param ScopeEntityInterface[] $scopes
     */
    public function setScopes(array $scopes)
    {
        $this->scopes = $scopes;
    }

    public function getScopes()
    {
        return $this->scopes;
    }
}

