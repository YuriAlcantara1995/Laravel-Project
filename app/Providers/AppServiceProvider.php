<?php

namespace App\Providers;

use App\Models\Property;
use App\Models\Realtor;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

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

        Gate::define('update-realtor', function (User $user, Realtor $realtor) {
            return $user->id === $realtor->user_id;
        });

        Gate::define('delete-realtor', function (User $user, Realtor $realtor) {
            return $user->id === $realtor->user_id;
        });

        Gate::define('update-property', function (User $user, Property $property) {
            return $user->id === $property->realtor->user_id;
        });

        Gate::define('delete-property', function (User $user, Property $property) {
            return $user->id === $property->realtor->user_id;
        });

        Health::checks([
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(70)
                ->failWhenUsedSpaceIsAbovePercentage(90),

            CacheCheck::new(),

            CpuLoadCheck::new()
            ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
            ->failWhenLoadIsHigherInTheLast15Minutes(1.5),

            DatabaseCheck::new(),

            EnvironmentCheck::new(),

            DebugModeCheck::new(),

            PingCheck::new()->url('http://yuri.harbourspace.site/'),
        ]);
    }
}
