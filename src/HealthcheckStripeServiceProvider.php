<?php

declare(strict_types=1);

namespace IllumaLaw\HealthCheckStripe;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class HealthcheckStripeServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('healthcheck-stripe')
            ->hasConfigFile()
            ->hasTranslations();
    }
}
