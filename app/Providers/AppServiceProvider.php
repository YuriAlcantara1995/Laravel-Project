<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Property;
use App\Models\Realtor;


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
        Paginator::useBootstrap();

        $this->register();

        Gate::define('update-realtor', function (User $user, Realtor $realtor) 
        {
            return $user->id === $realtor->user_id;
        });

        Gate::define('delete-realtor', function (User $user, Realtor $realtor) 
        {
            return $user->id === $realtor->user_id;
        });

        Gate::define('update-property', function (User $user, Property $property) 
        {
            return $user->id === $property->realtor->user_id;
        });

        Gate::define('delete-property', function (User $user, Property $property) 
        {
            return $user->id === $property->realtor->user_id;
        });

    }
}
