<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // SCHEDULE  — TABS
    // ══════════════════════════════════════════════════════════════════════════
    'tabs' => [
        'appointments' => 'Appointments',
        'availability'  => 'Availability',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SCHEDULE  — APPOINTMENTS TAB
    // ══════════════════════════════════════════════════════════════════════════
    'appointments' => [
        'reservation_notice'     => 'Appointments are reservation requests only',
        'reservation_notice_body'=> 'Payment and confirmation are handled directly by the clinic. Contact the parent before finalizing any appointment.',

        'new_requests'           => ':count New Requests',              // ⚠️ DYNAMIC — :count
        'new_requests_sub'       => 'You have :count new appointment requests that need your review.',  // ⚠️ DYNAMIC — :count
        'view'                   => 'View >',

        'upcoming_appointments'  => 'Upcoming Appointments',

        // Days of week (calendar strip)
        'days' => [
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
        ],

        // Appointment status badges
        'status' => [
            'completed' => 'Completed',
            'upcoming'  => 'Upcoming',
            'in_clinic' => 'In-Clinic',
            'online'    => 'Online',
            'cancelled' => 'Cancelled',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PATIENT INFO  (from Schedule)
    // ══════════════════════════════════════════════════════════════════════════
    'patient_info' => [
        'title'           => 'Patient Info',
        'age_started'     => ':age years old · Started :date',    // ⚠️ DYNAMIC — :age, :date
        'level'           => 'Level :level',                       // ⚠️ DYNAMIC — :level
        'progressing'     => 'Progressing',

        'appointment_info'=> 'Appointment Info',
        'date_time'       => 'Date & Time',
        'location'        => 'Location',
        'online_consult'  => 'Online Consultation',
        'clinic_visit'    => 'Clinic Visit',
        'parent_note'     => 'Parent note:',                       // ⚠️ DYNAMIC — free text from parent

        // Child's Cars Result
        'cars_result'         => 'The Child\'s Cars Result',
        'total_score'         => 'Total Score',
        'out_of'              => 'Out of :total points',           // ⚠️ DYNAMIC — :total
        'interpretation'      => 'Interpretation',

        // Score Interpretation Guide
        'score_guide'         => 'Score Interpretation Guide',
        'score_ranges' => [
            'no_autism'       => 'No signs of autism',
            'mild_autism'     => 'Mild Autism',
            'moderate_autism' => 'Moderate Autism',
            'severe_autism'   => 'Severe Autism',
        ],
        'score_labels' => [
            'range_1' => '15 - 26.5 points',
            'range_2' => '27 - 35.5 points',
            'range_3' => '36 - 47.5 points',
            'range_4' => '48 - 60 points',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // APPOINTMENT REQUESTS 
    // ══════════════════════════════════════════════════════════════════════════
    'appointment_requests' => [
        'title'           => 'Appointment Requests',

        'date_time'       => 'Date & Time',
        'location'        => 'Location',
        'clinic_visit'    => 'Clinic Visit',
        'online'          => 'Online',
        'parent_note'     => 'Parent note:',                       // ⚠️ DYNAMIC — free text

        'confirm'         => 'Confirm',
        'reject'          => 'Reject',

        // Reject dialog
        'reject_title'    => 'Are you sure you want to Reject this appointment request?',
        'reject_body'     => 'The parent will be notified that the appointment request was rejected.',
        'reject_cancel'   => 'Cancel',
        'reject_confirm'  => 'Yes, Reject it',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // AVAILABILITY TAB
    // ══════════════════════════════════════════════════════════════════════════
    'availability' => [
        'manage_notice'       => 'Manage Availability',
        'manage_notice_body'  => 'Control your appointments by taping any day to open it for bookings and select your available time slots.',

        // Calendar legend
        'legend' => [
            'today'     => 'Today',
            'available' => 'Available',
            'selected'  => 'Selected',
        ],

        'selected_day'        => 'Selected Day',                   // ⚠️ DYNAMIC — :date

        'available_today'     => 'Available Today',
        'available_today_sub' => 'Parents can book appointments.',
        'day_closed'          => 'This day is closed',
        'day_closed_sub'      => 'Parents cannot book appointments. Toggle availability ON to configure time slots.',

        'time_availability'   => 'Time Availability',
        'add_slot'            => '+',                              // add time slot button

        // Delete time slot dialog
        'delete_slot_title'   => 'Delete time slot',
        'delete_slot_save'    => 'Save',
        'delete_slot_cancel'  => 'Cancel',
    ],

];