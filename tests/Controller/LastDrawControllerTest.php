<?php
namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Response;

class LastDrawControllerTest extends TestCase
{

    public function testSuccessfulBeforePost()
    {
        $this->client->request('GET', '/dernier-tirage');

        dump($this->client->getResponse()->getStatusCode());

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}