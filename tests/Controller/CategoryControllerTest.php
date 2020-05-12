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

    public function testPostCollectionCategoryWithIncorrectData()
    {
        $client = static::createClient();
        $client->request('GET', '/category/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create new Category');

        $crawler = $client->submitForm('Save', [
            'category[name]' => '',
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertEquals('/category/new', $client->getRequest()->getRequestUri());
    }

    public function testPostCollectionCategoryWithValidData()
    {
        $client = static::createClient();
        $client->request('GET', '/category/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create new Category');

        $crawler = $client->submitForm('Save', [
            'category[name]' => 'python-'.rand(1, 10000),
        ]);

        $this->assertResponseRedirects('/category/');
    }
}
