<?php

use App\Jobs\SyncTrafficsJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new SyncTrafficsJob)->everyMinute()->withoutOverlapping(60);

