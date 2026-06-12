<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // PROGRESS  — HEADER
    // ══════════════════════════════════════════════════════════════════════════
    'header' => [
        'title'    => 'Your Child\'s Journey',
        'subtitle' => 'Track how your child grows through every activity',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // STATS ROW
    // ══════════════════════════════════════════════════════════════════════════
    'stats' => [
        'day_streak'  => 'Day Streak',
        'stars'       => 'Stars',
        'activities'  => 'Activities',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY THIS WEEK
    // ══════════════════════════════════════════════════════════════════════════
    'weekly' => [
        'title' => 'Activity This Week',
        'days'  => [
            'mon' => 'Mon',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'sun' => 'Sun',
        ],
        'empty' => [
            'title'    => 'No activities yet this week',
            'subtitle' => 'Once your child completes activities, their weekly progress will appear here',
            'btn'      => 'Start Your First Activity',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // MONTHLY PROGRESS
    // ══════════════════════════════════════════════════════════════════════════
    'monthly' => [
        'title' => 'Monthly Progress',
        'chart_labels' => [
            'activity' => 'Activity',
            'week_1'   => 'Week 1',
            'week_2'   => 'Week 2',
            'week_3'   => 'Week 3',
            'week_4'   => 'Week 4',
        ],
        'empty' => [
            'title'    => 'Complete activities to see your monthly trend',
            'subtitle' => 'Once your child completes activities, their Monthly Progress will appear here',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY MOOD TRACKER
    // ══════════════════════════════════════════════════════════════════════════
    'mood' => [
        'title'    => 'Activity Mood Tracker',
        'subtitle' => 'Based on your child\'s completed sessions',
        'feedback' => 'Child Feedback',
        'levels' => [
            'easy'   => 'Easy',
            'medium' => 'Medium',
            'hard'   => 'Hard',
        ],
        'moods' => [
            'happy'      => 'Happy',
            'calm'       => 'Calm',
            'frustrated' => 'Frustrated',
        ],
        'legend' => [
            'happy'      => 'Enjoyed It',
            'calm'       => 'It was okay',
            'frustrated' => 'Didn\'t enjoy it',
        ],
        'notes' => [
            'calm'       => 'Calm — percentage goes down as difficulty increases',
            'frustrated' => 'Frustrated — peaks at hard activities',
        ],
        'empty' => [
            'title'    => 'No mood data yet',
            'subtitle' => 'Mood tracking will show after your child completes their first session',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SKILLS DEVELOPMENT
    // ══════════════════════════════════════════════════════════════════════════
    'skills' => [
        'title' => 'Skills Development',
        'categories' => [
            'talking_connecting'   => 'Talking & Connecting',
            'moving_feeling'       => 'Moving & Feeling',
            'focus_learning'       => 'Focus & Learning',
            'feelings_calm'        => 'Feelings & Calm',
            'social_communication' => 'Social & Communication + Social Stories',
            'play_motor_sensory'   => 'Play & Motor Skills + Sensory Processing',
            'imitation_learning'   => 'Imitation & Learning',
            'emotional_behavioral' => 'Emotional & Behavioral',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // RECENT BADGES
    // ══════════════════════════════════════════════════════════════════════════
    'badges' => [
        'title' => 'Recent Badges',
        'types' => [
            'rising_star' => 'Rising Star',
            'super_star'  => 'Super Star',
            'legend'      => 'Legend',
        ],
        'stars_required' => ':count ⭐',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // DOWNLOAD REPORT
    // ══════════════════════════════════════════════════════════════════════════
    'report' => [
        'download' => 'Download Full Report',
    ],

];