<?php

namespace App\Tests\Service;

use App\Service\DrawService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\Exception\ClientException;

class DrawServiceTest extends KernelTestCase
{
    /** @var DrawService */
    private $drawService;

    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();
        $this->drawService = self::$container->get(DrawService::class);
    }

    public function set($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        self::bootKernel();
        $this->drawService = self::$container->get(DrawService::class);

    }

    public function testSuccessRetrieveDraws(): void
    {
        $response = $this->drawService->retrieveDraws([]);

        $this->assertIsArray($response);
        $this->assertNotEmpty($response);
    }

    public function testSuccessGetLastDraw(): void
    {
        $response = $this->drawService->getLastDraw();

        $this->assertIsArray($response);
        $this->assertCount(1, $response);
    }

    public function testFailWithWrongQuery()
    {
        $this->expectException(ClientException::class);
        $this->drawService->retrieveDraws(['range' => 'nope']);
    }
}
