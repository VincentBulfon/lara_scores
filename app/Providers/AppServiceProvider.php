<?php

namespace App\Providers;

use Illuminate\Support\Facades\View as View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Return an instance of carbon today date
     *
     * @var \Illuminate\Support\Carbon
     */
    protected $today = today();

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('date', $this->today);
    }
}
