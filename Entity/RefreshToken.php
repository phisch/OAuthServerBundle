<?php

namespace Phisch\OAuthServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Phisch\OAuth\Server\Entity\AccessTokenEntityInterface;

/**
 * @ORM\Table(name="refresh_token")
 * @ORM\Entity(repositoryClass="Phisch\OAuthServerBundle\Repository\RefreshTokenRepository")
 */
class RefreshToken
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
     * @ORM\Column(type="string")
     */
    private $identifier;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $expires;

    /**
     * @var AccessTokenEntityInterface
     * @ORM\OneToOne(targetEntity="AccessToken")
     * @ORM\JoinColumn(name="accesstoken_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $accessToken;

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

    /**
     * @return \DateTime
     */
    public function getExpiryDateTime()
    {
        return $this->expires;
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setExpiryDateTime(\DateTime $dateTime)
    {
        $this->expires = $dateTime;
    }

    /**
     * @param AccessTokenEntityInterface $accessToken
     */
    public function setAccessToken(AccessTokenEntityInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return AccessTokenEntityInterface
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
