<?php

declare(strict_types=1);

namespace IllumaLaw\HealthCheckStripe;

use Spatie\Health\Checks\Check;
use Spatie\Health\Checks\Result;
use Stripe\Balance;
use Throwable;

class StripeConnectivityCheck extends Check
{
    public function run(): Result
    {
        $secret = (string) config('cashier.secret');

        if ($secret === '') {
            return Result::make()
                ->failed('Stripe secret key is not configured.')
                ->shortSummary('Missing key');
        }

        $started = microtime(true);

        try {
            $balance = $this->fetchBalance($secret);
        } catch (Throwable $exception) {
            return Result::make()
                ->failed("Stripe API check failed: {$exception->getMessage()}")
                ->shortSummary('API error');
        }

        $latencyMs = (int) round((microtime(true) - $started) * 1000);

        $meta = [
            'response_time_ms' => $latencyMs,
            'livemode'         => $balance->livemode ?? null,
            'object'           => $balance->object ?? 'balance',
        ];

        if (isset($balance->available) && is_array($balance->available) && $balance->available !== []) {
            $first = $balance->available[0];
            $meta['currency'] = $first->currency ?? null;
        }

        $result = Result::make()
            ->ok('Stripe API credentials are valid.')
            ->shortSummary('Connected')
            ->meta($meta);

        if ($latencyMs > 1500) {
            return $result->warning("Stripe responded slowly ({$latencyMs}ms).");
        }

        return $result;
    }

    protected function fetchBalance(string $secret): object
    {
        return Balance::retrieve([], ['api_key' => $secret]);
    }
}
