<?php

use App\Console\Commands\UpdateGroupStatus;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Schedule;

Schedule::call(new UpdateGroupStatus)->daily('07:00');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());    
})->purpose('Display an inspiring quote')->hourly();



