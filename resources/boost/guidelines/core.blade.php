# illuma-law/healthcheck-stripe

Checks if the `vector` extension (stripe) is enabled and active in PostgreSQL.

## Usage

```php
use IllumaLaw\HealthCheckStripe\StripeExtensionCheck;
use Spatie\Health\Facades\Health;

Health::checks([
    StripeExtensionCheck::new()
        ->required(true), // If true, FAIL if missing. If false, WARNING.
]);
```

## Configuration

Publish config: `php artisan vendor:publish --tag="healthcheck-stripe-config"`

Options in `config/healthcheck-stripe.php`:
- `required`: (bool) Global default for strictness.
