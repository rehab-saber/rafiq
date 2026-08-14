<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Services\FcmService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendAppointmentReminders extends Command
{
    protected $signature = 'notifications:appointment-reminders';

    protected $description = 'Send appointment reminders to doctors';

    public function handle(FcmService $fcm)
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $bookings = Booking::with([
            'doctor',
            'child',
            'availability',
        ])
        ->where('status', 'confirmed')
        ->whereHas('availability', function ($query) use ($tomorrow) {

            $query->whereDate('date', $tomorrow)
                    ->where('is_active', true);

        })
        ->get();


        foreach ($bookings as $booking) {

            $doctor = $booking->doctor;

            if (!$doctor || !$doctor->fcm_token) {
                continue;
            }


            $settings = $doctor->settings()
                ->firstOrCreate([
                    'doctor_id' => $doctor->id,
                ]);


            if (!$settings->main_notifications) {
                continue;
            }


            if (!$settings->appointment_reminders) {
                continue;
            }


            $childName =
                $booking->child?->name ?? 'your child';

            $time =
                $booking->availability?->time;


            $fcm->send(
                $doctor->fcm_token,

                'Appointment Reminder',

                "You have an appointment with {$childName} tomorrow at {$time}.",

                [
                    'type' => 'appointment_reminder',
                    'booking_id' => $booking->id,
                    'child_id' => $booking->child_id,
                ]
            );
        }

        $this->info('Appointment reminders sent.');

        return Command::SUCCESS;
    }
}