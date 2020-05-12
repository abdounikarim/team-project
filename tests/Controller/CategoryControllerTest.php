<?php

namespace App\Tests\Controller;

use App\Entity\Category;

class CategoryControllerTest extends BaseController
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
        $categories = $this->getCategory()->findAll();
        /** @var Category $category */
        $category = $categories[0];
        $crawler = $client->request('GET', '/category/'.$category->getId());

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

    public function testPutItemCategoryWithValidData()
    {
        $client = static::createClient();
        $categories = $this->getCategory()->findAll();
        /** @var Category $category */
        $category = $categories[0];
        $crawler = $client->request('GET', '/category/'.$category->getId().'/edit');

        $this->assertResponseIsSuccessful();
    }
}
