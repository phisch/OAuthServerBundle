<?php

namespace Phisch\OAuthServerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Phisch\OAuth\Server\Entity\AccessTokenEntityInterface;
use Phisch\OAuth\Server\Entity\ClientEntityInterface;
use Phisch\OAuth\Server\Entity\ScopeEntityInterface;
use Phisch\OAuth\Server\Entity\UserEntityInterface;
use Phisch\OAuth\Server\Repository\AccessTokenRepositoryInterface;

class AccessTokenRepository extends EntityRepository implements AccessTokenRepositoryInterface
{
    public function createToken(ClientEntityInterface $client, UserEntityInterface $user, array $scopes, \DateTime $expires)
    {
        // TODO: Implement createToken() method.
    }
}
