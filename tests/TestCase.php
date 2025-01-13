<?php

declare(strict_types=1);

namespace Ajz\ApiResponse\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Ajz\ApiResponse\ApiHelpersServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            ApiHelpersServiceProvider::class,
        ];
    }
}