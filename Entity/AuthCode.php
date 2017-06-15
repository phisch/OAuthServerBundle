<?php

namespace Phisch\OAuthServerBundle\Entity;

use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Phisch\OAuth\Server\Entity\ClientEntityInterface;
use Phisch\OAuth\Server\Entity\ScopeEntityInterface;

/**
 * @ORM\Table(name="auth_code")
 * @ORM\Entity(repositoryClass="Phisch\OAuthServerBundle\Repository\AuthCodeRepository")
 */
class AuthCode
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
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(nullable=false)
     * @var Client
     */
    protected $client;

    /**
     * @var \Phisch\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Phisch\UserBundle\Entity\User")
     */
    protected $user;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $code;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $expires;

    /**
     * @var Scope[]
     * @ORM\ManyToMany(targetEntity="Scope")
     * @ORM\JoinTable(name="auth_code_scope", joinColumns={@ORM\JoinColumn(name="access_token_id", referencedColumnName="id")})
     */
    protected $scopes;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getRedirectUri()
    {
        // todo: why?
    }

    public function setRedirectUri($uri)
    {
        // todo: why?
    }

    public function getIdentifier()
    {
        return $this->getId();
    }

    public function setIdentifier($identifier)
    {
        // TODO: why would we want to set the identifier? should be done by doctrine with strategy="AUTO"
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
        // TODO: check if it's okay to set the user here
        $this->user = $identifier;
    }

    public function getUserIdentifier()
    {
        // TODO: check if it's okay to return the user here
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

    public function addScope(ScopeEntityInterface $scope)
    {
        $this->scopes[] = $scope;
    }

    public function getScopes()
    {
        return $this->scopes;
    }
}

