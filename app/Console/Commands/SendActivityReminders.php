<?php

namespace App\Console\Commands;

use App\Models\Child;
use App\Services\FcmService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendActivityReminders extends Command
{
    protected $signature = 'notifications:activity-reminders';

    protected $description = 'Send daily activity reminders to parents';

    public function handle(FcmService $fcm)
    {
        $today = Carbon::today();

        $children = Child::with([
            'parent',
            'activityAttempts',
        ])->get();

        foreach ($children as $child) {

            $parent = $child->parent;

            // مفيش Parent أو مفيش FCM Token
            if (!$parent || !$parent->fcm_token) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Parent Notification Settings
            |--------------------------------------------------------------------------
            */

            $settings = $parent->notificationSettings()
                ->firstOrCreate([
                    'parent_id' => $parent->id,
                ]);

            /*
            |--------------------------------------------------------------------------
            | Main Notifications
            |--------------------------------------------------------------------------
            */

            if (!$settings->main_notifications) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Activity Reminder
            |--------------------------------------------------------------------------
            */

            if (!$settings->activity_reminders) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Check Daily Activities
            |--------------------------------------------------------------------------
            */

            $completedToday = $child->activityAttempts()
                ->whereDate('completed_at', $today)
                ->whereNotNull('completed_at')
                ->count();

            /*
            |--------------------------------------------------------------------------
            | Daily Goal
            |--------------------------------------------------------------------------
            */

            $dailyGoal = $child->daily_session_goal ?? 0;

            /*
            |--------------------------------------------------------------------------
            | If Goal Is Completed
            |--------------------------------------------------------------------------
            */

            if ($dailyGoal > 0 && $completedToday >= $dailyGoal) {
                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Send Notification
            |--------------------------------------------------------------------------
            */

            $fcm->send(
                $parent->fcm_token,

                'Activity Reminder',

                "Don't forget to complete {$child->name}'s activities for today.",

                [
                    'type' => 'activity_reminder',
                    'child_id' => $child->id,
                    'parent_id' => $parent->id,
                ]
            );

            $this->info(
                "Reminder sent to parent {$parent->id} for child {$child->id}"
            );
        }

        $this->info('Activity reminders process completed.');

        return Command::SUCCESS;
    }
}