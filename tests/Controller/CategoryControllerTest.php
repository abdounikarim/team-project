<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testGetCollectionCategory()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/category/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Category index');
    }

    public function testGetItemCategory()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/category/1');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Category');
    }
}
