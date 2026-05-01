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
    'child_name'  => 'Sara Ahmed',
    'child_level' => 'Level 2 · Progressing',

    // ── Weekly Progress ───────────────────────────────
    'weekly_progress' => 'Weekly Progress',
    'days_progress'   => '2/6 Days',

    // ── Today's Activities ────────────────────────────
    'todays_activities' => "Today's Activities",
    'see_all'           => 'See All',
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
    'activities_names' => [
        'match_emotions'  => 'Match Emotions',
        'match_dolls'     => 'Match Dolls',
        'imitate_actions' => 'Imitate actions',
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
        'schedule_consultation' => 'Schedule consultation',
        'retake_assessment'     => 'Retake Assessment',
        'unlocks_level'         => 'Unlocks at Level 5',
    ],

    // ── For Parents ───────────────────────────────────
    'for_parents' => [
        'title'     => 'For Parents',
        'read_more' => 'Read More',
        'articles'  => [
            [
                'title' => 'How to improve communication skills at home',
                'desc'  => 'Simple daily exercises to encourage verbal and non-verbal communication.',
            ],
            [
                'title' => 'Understanding sensory overload',
                'desc'  => 'Learn to identify the signs of sensory overload and how to create a calming…',
            ],
        ],
    ],

    // ── Notifications ─────────────────────────────────
    'notifications' => [
        'title'    => 'Notifications',
        'mark_all' => 'Mark all read',
        'today'    => 'Today',
        'earlier'  => 'Earlier',

        'appointment' => [
            'title' => 'Upcoming Appointment',
            'desc'  => 'Dr. Amany Ali tomorrow at 10:00 AM',
            'time'  => '3h ago',
        ],

        'activity' => [
            'title' => 'Time for an Activity!',
            'desc'  => 'Sara hasn\'t completed any activities today. Try "Match Colors"',
            'time'  => '6h ago',
        ],

        'article' => [
            'title' => 'Recommended Article',
            'desc'  => 'Read "Positive reinforcement strategies"',
            'time'  => '18h ago',
        ],

        'great_job' => [
            'title' => 'Great job!',
            'desc'  => 'Sara completed 3 activities in a row, keep it up!',
            'time'  => '3 days ago',
        ],

        'milestone' => [
            'title' => 'New Milestone Reached',
            'desc'  => 'Sara reached Communication Level 1!',
            'time'  => '6 days ago',
        ],
    ],

];