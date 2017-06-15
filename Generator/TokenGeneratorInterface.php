<?php

namespace Phisch\OAuthServerBundle\Generator;

interface TokenGeneratorInterface
{
    /**
     * @return string
     */
    public function generateToken();
}
