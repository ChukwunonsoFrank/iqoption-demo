<?php

use App\Jobs\RefreshActiveBots;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new RefreshActiveBots)->everyFiveSeconds();
