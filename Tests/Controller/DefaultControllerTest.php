<?php

namespace Phisch\OAuthServerBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $crawler->filter('asd')->getNode()->


        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}
