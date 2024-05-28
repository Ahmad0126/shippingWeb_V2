<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::define('kantor', function(){
            return session('kantor')->fasilitas === 'Office';
        });
        Gate::define('kasir', function(User $user){
            return $user->level === 'Kasir' || $user->level === 'Admin';
        });
        Gate::define('officer', function(User $user){
            return $user->level === 'Officer' || $user->level === 'Admin';
        });
        Gate::define('kurir', function(User $user){
            return $user->level === 'Kurir' || $user->level === 'Admin';
        });
    }
}
