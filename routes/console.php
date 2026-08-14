<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(
    'notifications:appointment-reminders'
)->dailyAt('09:00');


Schedule::command(
    'notifications:weekly-progress'
)->weeklyOn(1, '09:00');

Schedule::command('notifications:activity-reminders')
    ->dailyAt('20:00');