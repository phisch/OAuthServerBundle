<?php

namespace Phisch\OAuthServerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Phisch\OAuth\Server\Entity\ScopeEntityInterface;
use Phisch\OAuth\Server\Repository\ScopeRepositoryInterface;

class ScopeRepository extends EntityRepository implements ScopeRepositoryInterface
{
    /**
     * @param string $identifier
     * @return ScopeEntityInterface
     */
    public function getScope($identifier)
    {
        // TODO: Implement getScope() method.
    }

    /**
     * @param array $identifiers
     * @return ScopeEntityInterface[]
     */
    public function getScopes(array $identifiers)
    {
        // TODO: Implement getScopes() method.
    }

    /**
     * @param string $spaceSeparatedScopeString
     * @return ScopeEntityInterface[]
     */
    public function getScopesBySpaceSeparatedString($spaceSeparatedScopeString)
    {
        $scopes = explode(' ', $spaceSeparatedScopeString);
        return $this->findBy(['name' => $scopes]);
    }
}
