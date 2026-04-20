<?php

declare(strict_types=1);

namespace IllumaLaw\HealthCheckStripe\Tests;

use IllumaLaw\HealthCheckStripe\HealthcheckStripeServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Health\HealthServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            HealthServiceProvider::class,
            HealthcheckStripeServiceProvider::class,
        ];
    }
}
