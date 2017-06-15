<?php

namespace Phisch\OAuthServerBundle\Generator;

class RandomTokenGenerator implements TokenGeneratorInterface
{
    public function generateToken()
    {
        $bytes = openssl_random_pseudo_bytes(32);
        if (false === $bytes) {
            $bytes = hash('sha256', uniqid(mt_rand(), true), true);
        }
        return base_convert(bin2hex($bytes), 16, 36);
    }

}