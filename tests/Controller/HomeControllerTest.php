<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase 
{
    public function testHomepage(){
        $client = static::createClient();
        $client->request(method: 'GET', uri: '/');
        $this->assertResponseStatusCodeSame(expectedCode: Response::HTTP_OK);
    }



}