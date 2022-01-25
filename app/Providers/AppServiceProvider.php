<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Property;
use App\Models\Realtor;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\PingCheck;

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

        Health::checks([
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(70)
                ->failWhenUsedSpaceIsAbovePercentage(90),
        ]);

        Health::checks([
            CacheCheck::new(),
        ]);

        Health::checks([
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
                ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
        ]);

        Health::checks([
            DatabaseCheck::new(),
        ]);

        Health::checks([
            EnvironmentCheck::new(),
        ]);

        Health::checks([
            DebugModeCheck::new(),
        ]);

        Health::checks([
            PingCheck::new()->url('http://yuri.harbourspace.site/'),
        ]);

    }
}
