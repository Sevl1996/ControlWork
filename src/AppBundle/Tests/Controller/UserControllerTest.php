<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testEdituser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editUser');
    }

    public function testAdduser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addUser');
    }

    public function testDeleteuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteUser');
    }

    public function testInfouser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/infoUser');
    }

}
