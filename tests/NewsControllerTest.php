<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsControllerTest extends WebTestCase
{
    public function testNews()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h1'));
        $this->assertSame(['week-601', 'symfony-live-usa-2018'], $crawler->filter('article')->extract(['id']));

        $link = $crawler->selectLink('Join us at SymfonyLive USA 2018!')->link();
        $crawler = $client->click($link);

        $this->assertSame('Join us at SymfonyLive USA 2018!', $crawler->filter('h1')->text());
    }
}

