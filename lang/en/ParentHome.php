<?php

return [

    // ── Bottom Navigation ─────────────────────────────
    'nav' => [
        'home'       => 'Home',
        'activities' => 'Activities',
        'progress'   => 'Progress',
        'doctors'    => 'Doctors',
        'profile'    => 'Profile',
    ],

    // ── Home ──────────────────────────────────────────
    'home'        => 'Home',
    // 'child_name' is dynamic — use :name placeholder when rendering
    'child_level' => 'Level :level · :status',

    // ── Weekly Progress ───────────────────────────────
    'weekly_progress' => 'Weekly Progress',
    'days_progress'   => ':done/:total Days',

    // ── Today's Activities ────────────────────────────
    'todays_activities' => "Today's Activities",
    'see_all'           => 'See All',
    'back'              => 'Back',
    'activity_count'    => ':count Activities',
    'not_started'       => 'Not started',
    'in_progress'       => 'In Progress',
    'start'             => 'Start',
    'continue'          => 'Continue',

    // ── Activity Types ────────────────────────────────
    'activity_types' => [
        'social_communication' => 'Social & Communication',
        'play_motor_skills'    => 'Play & Motor Skills',
        'imitation_learning'   => 'Imitation & Learning',
    ],

    // ── Activity Names ────────────────────────────────
    // Activity names come from the database — do not hardcode here.
    // These are kept only as fallback/reference examples.
    'activities_names' => [
        'match_emotions'  => 'Match Emotions',
        'match_dolls'     => 'Match Dolls',
        'imitate_actions' => 'Imitate Actions',
    ],

    // ── Achievements ──────────────────────────────────
    'achievements' => [
        'title'      => 'Your Achievements',
        'day_streak' => 'Day Streak',
        'stars'      => 'Stars',
        'activities' => 'Activities',
    ],

    // ── Quick Actions ─────────────────────────────────
    'quick_actions' => [
        'title'                 => 'Quick Actions',
        'book_doctor'           => 'Book a Doctor',
        'schedule_consultation' => 'Schedule Consultation',
        'retake_assessment'     => 'Retake Assessment',
        'unlocks_level'         => 'Unlocks at Level :level',
    ],

    // ── For Parents ───────────────────────────────────
    // Articles come from the database — titles & descriptions are dynamic.
    'for_parents' => [
        'title'     => 'For Parents',
        'read_more' => 'Read More',
    ],

    // ── Notifications ─────────────────────────────────
    'notifications' => [
        'title'    => 'Notifications',
        'mark_all' => 'Mark all read',
        'today'    => 'Today',
        'earlier'  => 'Earlier',

        // :doctor_name → dynamic (from DB)
        // :time        → dynamic (appointment time)
        'appointment' => [
            'title' => 'Upcoming Appointment',
            'desc'  => 'Dr. :doctor_name tomorrow at :time',
            'time'  => ':ago ago',
        ],

        // :name          → child's name (dynamic)
        // :activity_name → activity name (dynamic, from DB)
        'activity' => [
            'title' => 'Time for an Activity!',
            'desc'  => ":name hasn't completed any activities today. Try \":activity_name\"",
            'time'  => ':ago ago',
        ],

        // :article_title → article title (dynamic, from DB)
        'article' => [
            'title' => 'Recommended Article',
            'desc'  => 'Read ":article_title"',
            'time'  => ':ago ago',
        ],

        // :name  → child's name (dynamic)
        // :count → number of activities completed (dynamic)
        'great_job' => [
            'title' => 'Great job!',
            'desc'  => ':name completed :count activities in a row, keep it up!',
            'time'  => ':ago ago',
        ],

        // :name  → child's name (dynamic)
        // :milestone → milestone label (dynamic, from DB)
        'milestone' => [
            'title' => 'New Milestone Reached',
            'desc'  => ':name reached :milestone!',
            'time'  => ':ago ago',
        ],

        // :doctor_name → dynamic (from DB)
        // :message     → message content (dynamic)
        'new_message' => [
            'title' => 'New Message',
            'desc'  => 'Dr. :doctor_name: ":message"',
            'time'  => ':ago ago',
        ],
    ],

];