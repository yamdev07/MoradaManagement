<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Partager currentHotel avec toutes les vues
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user()->tenant_id) {
                $tenant = \App\Models\Tenant::find(Auth::user()->tenant_id);
                if ($tenant) {
                    $view->with('currentHotel', $tenant);
                }
            }
        });
    }
}
