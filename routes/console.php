<?php

use App\Jobs\RefreshActiveBots;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new RefreshActiveBots)->everySecond();
