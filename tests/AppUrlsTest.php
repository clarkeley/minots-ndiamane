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
    public function testPageIsSuccessful($url, $expectedStatus)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertEquals($client->getResponse()->getStatusCode(), $expectedStatus);
    }

    public function urlProvider()
    {
        yield ['/login', Response::HTTP_OK];
        yield ['/dashboard', Response::HTTP_FOUND];
        yield ['/album', Response::HTTP_FOUND];
        yield ['/addpicture', Response::HTTP_FOUND];
    }
}