<?php

namespace App\Providers;
use Dusterio\LumenPassport\LumenPassport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        // LumenPassport::tokensExpireIn(Carbon::now()->addMinutes(1)); 
        // LumenPassport::tokensExpireIn(Carbon::now()->addHour(24)); 
        LumenPassport::tokensExpireIn(Carbon::now()->addWeek(1));
        Schema::defaultStringLength(191);
    }
}
