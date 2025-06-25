<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ownerから始まるURL
        if (request()->is('owner*')) {
           config(['session.cookie' => config('session.cookie_owner')]);
        }
        // adminから始まるURL
        if (request()->is('admin*')) {
           config(['session.cookie' => config('session.cookie_admin')]);
        }

        if (! app()->runningInConsole()) {
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('owner')
                ->name('owner.')
                ->group(base_path('routes/owner.php'));

            Route::middleware('web')
                ->group(base_path('routes/auth.php'));
        }
    }
}
