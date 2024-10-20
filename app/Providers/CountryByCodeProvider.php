<?php

namespace App\Providers;

use App\Clients\CountryByPhoneClient;
use App\Interfaces\CountryByPhoneInterface;
use Illuminate\Support\ServiceProvider;

class CountryByCodeProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CountryByPhoneInterface::class, static function ($app): CountryByPhoneInterface {
            return new CountryByPhoneClient(
                env('COUNTRY_BY_PHONE_URL', ''),
                env('COUNTRY_BY_PHONE_API_KEY', '')
            );
        });
    }

}
