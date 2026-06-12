<?php

return [

    // ── Activities (Learning Areas) ───────────────────────
    'activities' => [
        'title'              => 'Learning Areas',

        // Filters
        'filter_all'         => 'All',
        'filter_in_progress' => 'In Progress',
        'filter_not_started' => 'Not Started',

        // Activity count & progress
        'activities_count'   => ':num Activities',
        'overall_progress'   => 'Overall Progress',
        'progress_percent'   => ':percent%',
        'level'              => 'Level :num',
    ],

    // ── Learning Area Categories ──────────────────────────
    'categories' => [
        'social_communication' => [
            'name'        => 'Social & Communication',
            'description' => 'Expressing needs, understanding others, and building relationships.',
        ],
        'play_motor' => [
            'name'        => 'Play & Motor Skills',
            'description' => 'Gross and fine motor coordination and physical play.',
        ],
        'sensory_processing' => [
            'name'        => 'Sensory Processing',
            'description' => 'Handling sensory input and creating comfortable environments.',
        ],
        'imitation_learning' => [
            'name'        => 'Imitation & Learning',
            'description' => 'Following instructions, matching, and cognitive skills.',
        ],
        'emotional_behavioral' => [
            'name'        => 'Emotional & Behavioral',
            'description' => 'Managing feelings, coping strategies, and self-regulation.',
        ],
        'social_stories' => [
            'name'        => 'Social Stories',
            'description' => 'Short role-play videos that help your child learn and handle real-life situations.',
        ],
    ],

    // ── Activity List (inside a category) ────────────────
    'activity_list' => [
        // Activity status badges
        'beginner_friendly'  => 'Beginner Friendly',
        'interactive'        => 'Interactive',

        // Lock/unlock
        'locked'             => 'Locked',

        // Buttons
        'start_activity'         => 'Start Activity',
        'continue_activity'      => 'Continue Activity',
        'start_activity_again'   => 'Start Activity Again',

        // Status labels
        'status_completed'   => 'Completed',
        'status_in_progress' => 'In Progress',
        'status_not_started' => 'Not Started',
    ],

    // ── Social Stories ────────────────────────────────────
    'social_stories' => [
        'title'              => 'Social Stories',
        'search_placeholder' => 'Search social stories...',

        // Category filters
        'filter_all'         => 'All',
        'filter_daily'       => 'Daily Living',
        'filter_communication' => 'Communication',
        'filter_behavior'    => 'Behavior',

        // Labels
        'all_levels'         => 'All Levels',
        'overall_progress'   => 'Overall Progress',
    ],

    // ── Story Detail ──────────────────────────────────────
    'story_detail' => [
        'title'              => 'Social Story',
        'script_title'       => 'Script',
        'read_more'          => 'Read more',
        'read_less'          => 'Read less',
        'related_stories'    => 'Related Stories',
    ],

];