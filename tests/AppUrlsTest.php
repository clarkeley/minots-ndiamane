<?php


namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class AppUrlsTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     * @param $url
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    public function urlProvider()
    {
        yield ['/login', Response::HTTP_OK];
        yield ['/dashboard', Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED];
        yield ['/album', Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED];
        yield ['/addpicture', Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED];
    }
}