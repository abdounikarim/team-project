<?php

namespace App\Tests\Controller;

use App\Entity\Link;

class LinkControllerTest extends BaseController
{
    public function testGetCollectionLink()
    {
        $client = $this->login('Paul0505@gmail.com','000000') ;
        $crawler = $client->request('GET', '/link/');

        $this->assertResponseRedirects();
    }
}
