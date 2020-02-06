<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TokenControllerTest extends WebTestCase
{
    public function testGettoken()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getToken');
    }

}
