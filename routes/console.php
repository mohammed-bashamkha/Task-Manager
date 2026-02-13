<?php

use App\Console\Commands\DeleteDoneTasks;
use App\Console\Commands\DeleteExpiredTasks;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(DeleteExpiredTasks::class)->monthlyOn(1, '00:00');
Schedule::command(DeleteDoneTasks::class)->monthlyOn(1, '00:00');
