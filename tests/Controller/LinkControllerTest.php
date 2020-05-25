<?php

namespace App\Tests\Controller;

use App\Entity\Link;

class LinkControllerTest extends BaseController
{
    public function testGetCollectionLink()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/link/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Link index');
    }
}
