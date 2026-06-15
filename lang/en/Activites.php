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

        // Empty / onboarding states
        'ready_to_start_title' => 'Ready to Get Started?',
        'ready_to_start_body'  => 'You haven\'t started any therapy sections yet. Begin your first section and track your child\'s progress step by step.',
        'great_job_title'      => 'Great Job!',
        'great_job_body'       => 'You\'ve already started all available therapy sections. Keep going and complete them one by one.',
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
        'beginner_friendly'    => 'Beginner Friendly',
        'interactive'          => 'Interactive',

        // Lock/unlock
        'locked'               => 'Locked',

        // Buttons
        'start_activity'       => 'Start Activity',
        'continue_activity'    => 'Continue Activity',
        'start_activity_again' => 'Start Activity Again',

        // Status labels
        'status_completed'     => 'Completed',
        'status_in_progress'   => 'In Progress',
        'status_not_started'   => 'Not Started',
    ],

    // ── Social Stories ────────────────────────────────────
    'social_stories' => [
        'title'                => 'Social Stories',
        'search_placeholder'   => 'Search social stories...',

        // Category filters
        'filter_all'           => 'All',
        'filter_daily'         => 'Daily Living',
        'filter_communication' => 'Communication',
        'filter_behavior'      => 'Behavior',

        // Labels
        'all_levels'           => 'All Levels',
        'overall_progress'     => 'Overall Progress',
    ],

    // ── Story Detail ──────────────────────────────────────
    'story_detail' => [
        'title'           => 'Social Story',
        'script_title'    => 'Script',
        'read_more'       => 'Read more',
        'read_less'       => 'Read less',
        'related_stories' => 'Related Stories',
    ],

    // ── Emotion Train ─────────────────────────────────────
    'emotion_train' => [
        'title'       => 'Emotion Train',
        'round'       => 'Round :current of :total',
        'instruction' => 'Drag & drop the emotions step by step onto the train',
        'reset_all'   => 'Reset All',
        'next'        => 'Next',

        // Emotion labels
        'emotions' => [
            'sad'       => 'Sad',
            'sleepy'    => 'Sleepy',
            'happy'     => 'Happy',
            'hug'       => 'Hug',
            'breath'    => 'Breath',
            'upset'     => 'Upset',
            'calm'      => 'Calm',
            'nothing'   => 'Nothing',
            'tired'     => 'Tired',
            'relaxed'   => 'Relaxed',
            'rest'      => 'Rest',
            'shy'       => 'Shy',
            'wave'      => 'Wave',
            'play'      => 'Play',
            'angry'     => 'Angry',
            'nervous'   => 'Nervous',
            'confident' => 'Confident',
            'better'    => 'Better',
        ],

        // Story sentences
        'stories' => [
            'sad_then_better'        => 'Rafiq was sad, then felt better',
            'upset_then_calm'        => 'Rafiq felt upset, then calmed down',
            'tired_needed_rest'      => 'Rafiq was tired and needed rest',
            'shy_made_friend'        => 'Rafiq was shy, then made a friend',
            'angry_then_calm'        => 'Rafiq was angry, then calmed down',
            'nervous_then_confident' => 'He was nervous, then felt confident',
        ],

        // Error state
        'error_title' => 'Not quite right',
        'error_body'  => 'Watch the emotions carefully, think about how Rafiq feels step by step.',
        'try_again'   => 'Try Again',

        // Completion
        'completed_title' => 'Great job! You completed the activity successfully',
        'stars_earned'    => 'You earned :count stars for this activity!',
        'next_button'     => 'Next',
    ],

    // ── Emotion Train Feedback ────────────────────────────
    'emotion_train_feedback' => [
        'title'                => 'Emotion Train Feedback',
        'session_insights'     => 'Session Insights',
        'session_insights_body'=> 'Let your child share their feelings and activity experience to improve personalized therapy sessions.',

        // Difficulty
        'difficulty_title'    => 'Difficulty Feedback',
        'difficulty_question' => 'How difficult was this activity?',
        'easy'                => 'Easy',
        'easy_desc'           => 'I completed it with little or no help.',
        'medium'              => 'Medium',
        'medium_desc'         => 'Some parts were challenging, but I did it.',
        'hard'                => 'Hard',
        'hard_desc'           => 'I found it difficult and needed support.',

        // Mood
        'mood_title'          => 'Mood Feedback',
        'mood_question'       => 'How did you feel during the activity?',
        'mood_sub'            => 'Which emotion best describes how you felt during the activity?',
        'happy'               => 'Happy',
        'happy_desc'          => 'I enjoyed this activity and had fun.',
        'calm'                => 'Calm',
        'calm_desc'           => 'I felt relaxed and comfortable while completing it.',
        'frustrated'          => 'Frustrated',
        'frustrated_desc'     => 'Some parts were difficult and made me feel upset.',

        'submit'              => 'Submit Feedback',
    ],

];