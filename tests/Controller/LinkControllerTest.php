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

    public function testPostCollectionLinkWithValidData()
    {
        $client = $this->login('Paul0505@gmail.com','000000') ;
        $client->request('GET', '/link/new');

        $this->assertResponseIsSuccessful();

        $crawler = $client->submitForm('Save', [
            'link[description]' => 'link',
            'link[link]' => 'https..',
            'link[category]' => 'PHP'
        ]);

        $this->assertResponseRedirects('/link/');
    }
}
