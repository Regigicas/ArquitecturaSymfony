<?php

namespace InfractorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testGethome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/home_infractor');
    }

}
