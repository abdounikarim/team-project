<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function login($user,$pass) {
        return static::createClient([], [
            'PHP_AUTH_USER' => $user,
            'PHP_AUTH_PW' => $pass,
        ]);
    }

    public function testRegister()
    {
        $client = static::createClient();
        $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
    }

    public function testGetLogin(){
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostLoginSucces(){
        $client = $this->login('Paul0505@gmail.com','000000') ;
        $client->request('POST', '/login');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testPOSTLoginWithFalseInformation(){
        $client = $this->login('','0') ;
        $client->request('POST', '/login');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }

    public function testGetRegister(){
        $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testPostRegistrationWithIncorrectData(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $crawler = $client->submitForm('Register', [
            'registration_form[email]' => 'Fabien',
            'registration_form[plainPassword]' => '',
            'registration_form[agreeTerms]' => true,
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testPostRegistrationWithCorrectData(){
        $client = static::createClient();
        $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        
        $crawler = $client->submitForm('Register', [
            'registration_form[email]' => 'Fabien'.rand(1, 10000).'@gmail.com',
            'registration_form[plainPassword]' => '000000',
            'registration_form[agreeTerms]' => true,
        ]);

        $this->assertResponseRedirects('/');

        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
    
}
