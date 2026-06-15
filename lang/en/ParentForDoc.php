<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // PATIENTS LIST 
    // ══════════════════════════════════════════════════════════════════════════
    'patients' => [
        'title'              => 'Patients',
        'search_placeholder' => 'Search by child name...',

        // Filter tabs
        'filter' => [
            'all'          => 'All',
            'active'       => 'Active',
            'needs_review' => 'Needs Review',
        ],

        // Patient card
        'overall_progress' => 'Overall Progress',
        'last_activity'    => 'Last Activity',          // ⚠️ DYNAMIC — :time ago

        // Status badges
        'status' => [
            'active'       => 'Active',
            'needs_review' => 'Needs Review',
        ],

        // Empty states
        'empty_no_patients'     => 'Add your first patient to start tracking their therapy journey',
        'add_patients_btn'      => '+ Add Patients',

        'empty_no_plan'         => 'Patients will show here once they have an ongoing therapy plan',

        'empty_no_review'       => 'No patients need review right now. Keep up the great work!',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PATIENT PROFILE 
    // ══════════════════════════════════════════════════════════════════════════
    'patient_profile' => [
        'title'          => 'Patient Profile',
        'parent_role'    => 'Parent Role',              // ⚠️ DYNAMIC — e.g. "Parent Note"

        // Action buttons
        'message'        => 'Message',
        'edit_plan'      => 'Edit Plan',
        'make_plan'      => 'Make Plan',

        // Tabs
        'tabs' => [
            'overview'      => 'Overview',
            'therapy_plan'  => 'Therapy Plan',
        ],

        // ── OVERVIEW TAB ──────────────────────────────────────────────────
        'overall_progress'     => 'Overall Progress',
        'overall_progress_sub' => 'Based on completed home activities',  // ⚠️ DYNAMIC — :percent%

        'activity_this_week'   => 'Activity This Week',
        'no_activities_week'   => 'No activities yet this week',
        'no_activities_sub'    => 'Once your patient completes activities, their weekly progress will appear here',
        'make_plan_btn'        => 'Make a Plan',

        // Days of week (chart x-axis)
        'days' => [
            'mon' => 'Mon',
            'sat' => 'Sat',
            'sun' => 'Sun',
            'tue' => 'Tue',
            'wed' => 'Wed',
            'thu' => 'Thu',
        ],

        'monthly_progress'     => 'Monthly Progress',
        'assign_activities'    => 'Assign Activities to see progress',
        'assign_activities_sub'=> 'Once your patient completes activities, their Monthly Progress will appear here',

        // Weeks (chart x-axis)
        'weeks' => [
            'week_1' => 'Week 1',
            'week_2' => 'Week 2',
            'week_3' => 'Week 3',
            'week_4' => 'Week 4',
        ],

        'activity_mood_tracker'     => 'Activity Mood Tracker',
        'mood_tracker_sub'          => 'Based on the child\'s completed sessions',
        'no_mood_yet'               => 'No mood data yet',
        'no_mood_yet_sub'           => 'Mood tracking will show after your patient completes their first session',

        // Mood labels
        'moods' => [
            'gold'      => 'Gold',
            'happy'     => 'Happy',
            'calm'      => 'Calm',
            'frustrated'=> 'Frustrated',
        ],

        // Difficulty levels
        'difficulty' => [
            'easy'   => 'Easy',
            'medium' => 'Medium',
            'hard'   => 'Hard',
        ],

        // Mood chart legend
        'mood_legend' => [
            'calm'      => 'Calm — percentage goes down as difficulty increases',
            'frustrated'=> 'Frustrated — peaks at hard activities',
        ],

        'skills_development'   => 'Skills Development',
        'skills' => [
            'talking_connecting' => 'Talking & Connecting',
            'moving_feeling'     => 'Moving & Feeling',
            'focus_learning'     => 'Focus & Learning',
            'feelings_calm'      => 'Feelings & Calm',
        ],

        'download_full_report' => 'Download Full Report',

        // ── THERAPY PLAN TAB ──────────────────────────────────────────────
        'therapy_plan' => [
            'social_communication'   => 'Social & Communication',
            'social_comm_sub'        => 'Expressing needs, understanding others, and building relationships.',
            'play_motor_skills'      => 'Play & Motor Skills',
            'play_motor_sub'         => 'Gross and fine motor coordination and physical play.',
            'sensory_processing'     => 'Sensory Processing',
            'sensory_sub'            => 'Handling sensory input and creating comfortable environments.',
            'imitation_learning'     => 'Imitation & Learning',
            'imitation_sub'          => 'Following instructions, matching, and cognitive skills.',
            'emotional_behavioral'   => 'Emotional & Behavioral',
            'emotional_sub'          => 'Managing feelings, coping strategies, and self-regulation.',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // BUILD PLAN 
    // ══════════════════════════════════════════════════════════════════════════
    'build_plan' => [
        'title'       => 'Build Plan',
        'notice'      => 'Build Personalized Plans',
        'notice_body' => 'Inside every section, you can choose the appropriate level and select the activities you want to include in the child\'s plan.',

        // Categories (same as therapy plan)
        'categories' => [
            'social_communication' => 'Social & Communication',
            'play_motor_skills'    => 'Play & Motor Skills',
            'sensory_processing'   => 'Sensory Processing',
            'imitation_learning'   => 'Imitation & Learning',
            'emotional_behavioral' => 'Emotional & Behavioral',
        ],

        // Levels
        'levels' => [
            'level_1' => 'Level 1',
            'level_2' => 'Level 2',
            'level_3' => 'Level 3',
            'level_4' => 'Level 4',
        ],

        'save_changes' => 'Save Changes',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SOCIAL & COMMUNICATION  (Activity selection inside Build Plan)
    // ══════════════════════════════════════════════════════════════════════════
    'social_communication' => [
        'title'             => 'Social & Communication',
        'selected_activities' => 'Selected Activities',    // ⚠️ DYNAMIC — :count

        // Activities list
        'activities' => [
            'eye_contact_game'         => 'Eye Contact Game',
            'turn_taking_with_toys'    => 'Turn-Taking with Toys',
            'emotion_recognition_cards'=> 'Emotion Recognition Cards',
            'group_interaction'        => 'Group Interaction',
            'expressing_feelings'      => 'Expressing Feelings',
            'question_answer_practice' => 'Question & Answer Practice',
        ],

        'save_changes' => 'Save Changes',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PLAY & MOTOR SKILLS 
    // ══════════════════════════════════════════════════════════════════════════
    'play_motor_skills' => [
        'title'           => 'Play & Motor Skills',
        'overall_progress'=> 'Overall Progress',          // ⚠️ DYNAMIC — :percent%

        // Activities
        'activities' => [
            'greeting_others'    => 'Greeting Others',
            'asking_for_help'    => 'Asking for Help',
            'turn_taking'        => 'Turn Taking',
            'identifying_emotions' => 'Identifying Emotions',
            'eye_contact_game'   => 'Eye Contact Game',
            'sharing_toys'       => 'Sharing Toys',
        ],
    ],
    
    
    // ══════════════════════════════════════════════════════════════════════════
    // DAILY SESSION GOAL
    // ══════════════════════════════════════════════════════════════════════════
    'daily_session_goal' => [
        'title'    => 'Daily Session Goal',
        'question' => 'Choose how long the child should practice on your plan daily',
        '15_min'      => '15 Minutes',
        '15_min_desc' => 'Includes 2 activities from the selected therapy sections',

        '30_min'      => '30 Minutes',
        '30_min_desc' => 'Includes 3 activities from the selected therapy sections',
 
        '45_min'      => '45 Minutes',
        '45_min_desc' => 'Includes 4 activities from the selected therapy sections',
 
        'save_changes' => 'Save Changes',
    ],
 
];