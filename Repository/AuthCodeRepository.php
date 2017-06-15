<?php

namespace Phisch\OAuthServerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Phisch\OAuth\Server\Repository\AuthCodeRepositoryInterface;

class AuthCodeRepository extends EntityRepository implements AuthCodeRepositoryInterface
{

}
