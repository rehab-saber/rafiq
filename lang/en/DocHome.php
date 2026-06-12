<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // HOME SCREEN — HEADER
    // ══════════════════════════════════════════════════════════════════════════
    'header' => [
        'today_sessions'    => 'Today: :count sessions',
        'next_session'      => 'Next at :time',
        'no_sessions'       => 'Today: 0 sessions',
        'no_sessions_sub'   => 'There are no sessions today',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // STATS ROW
    // ══════════════════════════════════════════════════════════════════════════
    'stats' => [
        'active_patients'   => 'Active Patients',
        'pending_requests'  => 'Pending Requests',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PASSCODE MANAGEMENT
    // ══════════════════════════════════════════════════════════════════════════
    'passcode' => [
        'title'              => 'Passcode Management',
        'free_passcodes'     => 'Free Passcodes',
        'free_count'         => ':used of :total used',
        'go_to_passcodes'    => 'Go to Passcodes',

        // Passcode Management Screen
        'usage_analytics'    => 'Usage Analytics',
        'used_count'         => ':used of :total used',
        'pending_requests'   => 'Pending Join Requests',
        'wants_to_join'      => 'wants to join using your passcode',
        'accept'             => 'Accept',
        'decline'            => 'Decline',
        'generated_passcodes'=> 'Generated Passcodes',
        'used'               => 'Used',
        'unused'             => 'Unused',
        'assigned_to_parent' => 'Assigned to parent',
        'generate_new'       => 'Generate New Passcode',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // WEEKLY ENGAGEMENT
    // ══════════════════════════════════════════════════════════════════════════
    'engagement' => [
        'title'           => 'Weekly Engagement',
        'completion_rate' => 'Activities completion rate',
        'assigned'        => 'Assigned',
        'completed'       => 'Completed',
        'days' => [
            'sun' => 'Sun',
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PREMIUM INSIGHTS
    // ══════════════════════════════════════════════════════════════════════════
    'premium' => [
        'title'            => 'Premium Insights',
        'unlock_analytics' => 'Unlock Advanced Analytics',
        'unlock_desc'      => 'Get deep insights into child progress, therapy completion rates, and more.',
        'unlock_btn'       => 'Unlock with Premium',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // NOTIFICATIONS SCREEN
    // ══════════════════════════════════════════════════════════════════════════
    'notifications' => [
        'title'         => 'Notifications',
        'mark_all_read' => 'Mark all as read',
        'today'         => 'Today',
        'earlier'       => 'Earlier',

        // Notification Templates (dynamic values come from backend)
        'types' => [
            'new_appointment'   => 'New Appointment Request — :name requested a clinic visit',
            'milestone_reached' => 'Milestone Reached — Improved in :skill by :percent%',
            'new_passcode'      => 'New Passcode Join Request — :name sent your passcode to :target',
            'new_message'       => 'New Message — :name completed the primary activity',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // BOTTOM NAVIGATION (Doctor)
    // ══════════════════════════════════════════════════════════════════════════
    'bottom_nav' => [
        'home'      => 'Home',
        'patients'  => 'Patients',
        'schedule'  => 'Schedule',
        'chat'      => 'Chats',
        'profile'   => 'Profile',
    ],

];