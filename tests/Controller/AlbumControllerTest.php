<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AlbumControllerTest extends WebTestCase
{
    public function testValidData()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'toto',
            'PHP_AUTH_PW'   => 'toto',
        ]);

        $crawler = $client->request('GET', '/album');

        $buttonCrawlerNode = $crawler->selectButton('Envoyer');

        $form = $buttonCrawlerNode->form([
            'album[title]' => 'Album test',
            'album[date]' => '2019-07-22',
            'album[caption]' => 'album de test',
        ]);

        $client->submitForm($form);

        $this->assertResponseRedirects('/album');
    }
}