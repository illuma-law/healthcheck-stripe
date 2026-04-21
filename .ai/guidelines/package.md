---
description: Stripe API connectivity and credential health check for Spatie Laravel Health
---

# healthcheck-stripe

Stripe API connectivity and credential health check for `spatie/laravel-health`. Verifies `CASHIER_SECRET`/`STRIPE_SECRET` is valid and Stripe's API is reachable.

## Namespace

`IllumaLaw\HealthCheckStripe`

## Key Check

- `StripeConnectivityCheck` — makes a lightweight Stripe API call; measures latency; warns if > 1500ms

## Registration

```php
use IllumaLaw\HealthCheckStripe\StripeConnectivityCheck;
use Spatie\Health\Facades\Health;

Health::checks([
    StripeConnectivityCheck::new()
        ->required(true),
]);
```

## Config

Publish: `php artisan vendor:publish --tag="healthcheck-stripe-config"`

Options in `config/healthcheck-stripe.php`:
- `required`: (bool) Global default for strictness.

## Notes

- Reads `CASHIER_SECRET` (fallback: `STRIPE_SECRET`) for credentials.
- Returns `warning` if latency > 1500ms; returns `failed` if credentials are invalid or API is unreachable.
- Use `required(false)` in non-billing environments (staging with no Stripe key) to degrade gracefully.
