<?php

namespace Phisch\OAuthServerBundle\Entity\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Phisch\OAuthServerBundle\Entity\Client;
use Phisch\OAuthServerBundle\Generator\TokenGeneratorInterface;

class ClientListener
{
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * ClientListener constructor.
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(TokenGeneratorInterface $tokenGenerator)
    {
        $this->tokenGenerator = $tokenGenerator;
    }

    public function prePersist(Client $client, LifecycleEventArgs $event)
    {
        if ($client->getId() === null) {
            if ($client->getClientId() === null) {
                $client->setClientId($this->tokenGenerator->generateToken());
            }

            if ($client->getSecret() === null) {
                $client->setSecret($this->tokenGenerator->generateToken());
            }
        }
    }
}
