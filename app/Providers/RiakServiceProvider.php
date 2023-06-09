<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Facades\Health;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\MeiliSearchCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;




class RiakServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            CpuLoadCheck::new()
            ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
            ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
            DatabaseSizeCheck::new()
            ->failWhenSizeAboveGb(errorThresholdGb: 5.0),
            OptimizedAppCheck::new(),
            DatabaseConnectionCountCheck::new()
            ->warnWhenMoreConnectionsThan(50)
            ->failWhenMoreConnectionsThan(100),
            MeiliSearchCheck::new()->url('http://127.0.0.1:8000/login'),
            ScheduleCheck::new()
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
