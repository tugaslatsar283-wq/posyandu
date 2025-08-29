<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <- WAJIB DITAMBAHKAN

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Definisikan role superadmin & kecamatan
        Gate::define('access-all', function ($user) {
            return in_array($user->role, ['superadmin', 'kecamatan']);
        });
    }
}
