<?php

namespace Phisch\OAuthServerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Phisch\OAuth\Server\Entity\AccessTokenEntityInterface;
use Phisch\OAuth\Server\Entity\RefreshTokenEntityInterface;
use Phisch\OAuth\Server\Repository\RefreshTokenRepositoryInterface;

class RefreshTokenRepository extends EntityRepository implements RefreshTokenRepositoryInterface
{
    public function createToken(AccessTokenEntityInterface $accessTokenEntity, \DateTime $expiryDateTime)
    {
        // TODO: Implement createToken() method.
    }
}
