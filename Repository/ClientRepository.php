<?php

namespace Phisch\OAuthServerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Phisch\OAuth\Server\Entity\ClientEntityInterface;
use Phisch\OAuth\Server\Repository\ClientRepositoryInterface;

class ClientRepository extends EntityRepository implements ClientRepositoryInterface
{
    public function getClient($clientId)
    {
        return $this->findOneBy(['clientId' => $clientId]);
    }
}
