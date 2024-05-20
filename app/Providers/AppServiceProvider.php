<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrapFive();
        
        //definisikan gate bernama admin dimana gate hanya bisa diakses oleh user yang usernamenya ........
        Gate::define('admin', function(User $user){
            return $user->is_admin;
        });
    }
}
