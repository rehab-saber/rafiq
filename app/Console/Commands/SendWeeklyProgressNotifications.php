<?php

namespace App\Console\Commands;

use App\Models\ActivityAttempt;
use App\Models\Child;
use App\Services\FcmService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendWeeklyProgressNotifications extends Command
{
    protected $signature = 'notifications:weekly-progress';

    protected $description = 'Send weekly progress notifications to doctors';

    public function handle(FcmService $fcm)
    {
        $from = Carbon::now()->subDays(7);

        $children = Child::with([
            'parent.doctor'
        ])->get();


        foreach ($children as $child) {

            $doctor = $child->parent?->doctor;

            if (!$doctor || !$doctor->fcm_token) {
                continue;
            }


            $hasProgress = ActivityAttempt::where(
                'child_id',
                $child->id
            )
            ->where(
                'created_at',
                '>=',
                $from
            )
            ->exists();


            if (!$hasProgress) {
                continue;
            }


            $settings = $doctor->settings()
                ->firstOrCreate([
                    'doctor_id' => $doctor->id,
                ]);


            if (!$settings->main_notifications) {
                continue;
            }


            if (!$settings->progress_alerts) {
                continue;
            }


            $fcm->send(
                $doctor->fcm_token,

                'Weekly Progress',

                "{$child->name}'s weekly progress is ready.",

                [
                    'type' => 'weekly_progress',
                    'child_id' => $child->id,
                ]
            );
        }


        $this->info('Weekly progress notifications sent.');

        return Command::SUCCESS;
    }
}