<?php

namespace InfractorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{
    public function testGetlogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
    }

}
