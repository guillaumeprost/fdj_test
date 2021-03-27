<?php

namespace App\Tests\Service;

use App\Kernel;
use App\Service\DrawService;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\HttpClient;

class DrawServiceTest extends KernelTestCase
{
    public function testSuccessRetrieveDraws(): void
    {
        self::bootKernel();
        // gets the special container that allows fetching private services
        $drawService = self::$container->get(DrawService::class);

        // this line is important ↓
//        $drawService = $container->get(DrawService::class);

        dump($drawService);exit;

    }
}
