<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FrontControllerTest extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testFollowTechnologiesPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/follow');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testFeedPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/feed');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}