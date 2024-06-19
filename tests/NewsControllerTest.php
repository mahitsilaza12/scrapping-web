<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class NewsControllerTest extends PantherTestCase
{
    public function testNews()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/');

        // Vérifie qu'il y a deux éléments <h1> sur la page
        $this->assertCount(2, $crawler->filter('h1'));

        // Modifie pour passer un tableau contenant 'id'
        $this->assertSame(['week-601', 'symfony-live-usa-2018'], $crawler->filter('article')->extract(['id']));

        // Sélectionne un lien par son texte et clique dessus
        $link = $crawler->selectLink('Join us at SymfonyLive USA 2018!')->link();
        $crawler = $client->click($link);

        // Vérifie le texte du <h1> après avoir cliqué sur le lien
        $this->assertSame('Join us at SymfonyLive USA 2018!', $crawler->filter('h1')->text());
    }
}
