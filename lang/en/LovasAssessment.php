<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // INTRO SCREEN
    // ══════════════════════════════════════════════════════════════════════════
    'intro' => [
        'app_title'        => 'Lovaas Assessment',
        'app_subtitle'     => 'Interactive Confirmation Activities',
        'description'      => 'This assessment consists of personalized activities designed to evaluate various developmental areas.',
        'note_1'           => 'Both the number and type of activities are dynamically determined based on the child\'s selected responses in the CARS assessment.',
        'about'            => 'About the Assessment',
        'duration'         => 'Duration',
        'duration_value'   => 'Approximately 20-30 minutes',
        'parent_guidance'  => 'Parent Guidance',
        'parent_value'     => 'You\'ll observe and record responses',
        'child_friendly'   => 'Child-Friendly',
        'child_value'      => 'Calm, engaging, and supportive',
        'footer_note'      => 'Note: If the child demonstrates mastery of the assigned activities, this section will be excluded from the personalized development plan.',
        'start_btn'        => 'Start Assessment',
        'lang'             => 'Lang',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // NAVIGATION
    // ══════════════════════════════════════════════════════════════════════════
    'nav' => [
        'next_activity' => 'Next Activity',
        'next_stage'    => 'Next Stage',
        'next'          => 'Next',
        'activity_of'   => 'Activity :current of :total',
        'app_name'      => 'Lovaas Assessment',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PARTICIPANTS SCREEN
    // ══════════════════════════════════════════════════════════════════════════
    'participants' => [
        'title'        => 'Participants',
        'add_btn'      => 'Add Participant',
        'dialog_title' => 'Add Participant',
        'dialog_desc'  => 'The participant involved in the conversation activity',
        'male'         => 'Male',
        'female'       => 'Female',
        'upload_photo' => 'Upload or Take Photo',
        'name_hint'    => 'Write your name',
        'add'          => 'Add',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 1 — Social Interaction
    // ══════════════════════════════════════════════════════════════════════════
    'activity_1' => [
        'title'          => 'Social Interaction',
        'subtitle'       => 'This activity should be conducted with at least 3 participants to assess turn-taking skills and social interaction with others.',
        'prompt'         => 'Tell us your name, your age, and something you like.',
        'parent_label'   => 'PARENT RESPONSE',
        'parent_question'=> 'How did the child respond?',
        'select_hint'    => 'Select the option that best describes how your child responded',
        'start_btn'      => 'Start Activity',
        'options' => [
            'independent' => 'Introduced self independently',
            'with_support'=> 'Introduced self with support',
            'no_response' => 'Did not respond',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 2 — Imitation
    // ══════════════════════════════════════════════════════════════════════════
    'activity_2' => [
        'title'          => 'Imitation',
        'subtitle'       => 'Copy the movements shown',
        'movement_label' => 'Movement',
        'repeat_btn'     => 'Repeat Movement',
        'parent_label'   => 'PARENT RESPONSE',
        'parent_question'=> 'How did the child respond?',
        'select_hint'    => 'Select the option that best describes how your child responded',
        'movements' => [
            'clap'     => '👏 Clap',
            'tap_legs' => '✋ Tap legs',
            'wave'     => '👋 Wave',
        ],
        'options' => [
            'all_steps'    => 'Imitated independently in all steps',
            'needed_help'  => 'Needed help in one or more steps',
            'no_imitation' => 'Did not imitate at all',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 3 — Emotional Response
    // ══════════════════════════════════════════════════════════════════════════
    'activity_3' => [
        'title'          => 'Emotional Response',
        'subtitle'       => 'Tell us how you feel',
        'scenario_label' => 'Scenario',
        'scenario_text'  => '"If someone takes your toy, how do you react?"',
        'parent_label'   => 'PARENT RESPONSE',
        'parent_question'=> 'How would your child respond if someone took their toy?',
        'select_hint'    => 'Select the child\'s typical reaction',
        'options' => [
            'ask_nicely'  => 'Ask nicely for the toy back',
            'cry_upset'   => 'Cry and get upset',
            'hit_grab'    => 'Hit or grab the toy',
            'would_cry'   => 'Would cry',
            'would_angry' => 'Would get angry, grab the toy',
            'would_ask'   => 'Would ask for the toy back',
            'no_react'    => 'Would not react',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 4 — Body Use
    // ══════════════════════════════════════════════════════════════════════════
    'activity_4' => [
        'title'          => 'Body Use',
        'subtitle'       => 'Follow the audio instruction',
        'tap_hint'       => 'Tap the image to hear the instruction',
        'instruction'    => '"Raise your hand"',
        'parent_note'    => 'For parent: Observe if the child follows the instruction',
        'parent_question'=> 'How did the child respond?',
        'select_hint'    => 'Select the child\'s typical reaction',
        'options' => [
            'performed'    => 'Performed the movement',
            'needed_guide' => 'Attempted but needed guidance',
            'no_attempt'   => 'Did not attempt or respond',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 5 — Object Use
    // ══════════════════════════════════════════════════════════════════════════
    'activity_5' => [
        'title'       => 'Object Use',
        'subtitle'    => 'Drag items to their matching places',
        'items_label' => 'Items to Match',
        'zones_label' => 'Drop Zones',
        'completion'  => 'Completion: :placed of :total items placed',
        'items' => [
            'toothbrush' => 'Toothbrush',
            'ball'       => 'Ball',
            'spoon'      => 'Spoon',
        ],
        'zones' => [
            'playground' => 'Playground',
            'kitchen'    => 'Kitchen',
            'bathroom'   => 'Bathroom',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 6 — Flexibility & Routine
    // ══════════════════════════════════════════════════════════════════════════
    'activity_6' => [
        'title'          => 'Flexibility & Routine',
        'subtitle'       => 'Adapting to changes',
        'lets_try'       => 'Let\'s try something different!',
        'switching'      => 'switching to a new activity',
        'hold_hint'      => 'Keep holding to fill the Magic Bubble',
        'bubbles_popped' => 'Bubbles Popped: :count/:total',
        'well_done'      => 'Well Done! You filled it all!',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 7 — Visual Sense
    // ══════════════════════════════════════════════════════════════════════════
    'activity_7' => [
        'title'        => 'Visual Sense',
        'subtitle'     => 'Find the differences between images',
        'image_1'      => 'Image 1',
        'image_2'      => 'Image 2',
        'tap_hint'     => 'Tap the differences you find',
        'look_careful' => 'Look carefully',
        'differences'  => 'Differences',
        'progress'     => ':found/:total',
        'keep_looking' => 'Great! Keep looking for :remaining more',
        'well_done'    => 'Well done! You found them all.',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 8 — Auditory Sense
    // ══════════════════════════════════════════════════════════════════════════
    'activity_8' => [
        'title'       => 'Auditory Sense',
        'subtitle'    => 'Listen and match the sound',
        'tap_to_hear' => 'Tap to hear the sound',
        'playing'     => '🔊 Playing sound....',
        'env_sound'   => 'Environmental sound',
        'which_scene' => 'Which scene matches the sound?',
        'scenes' => [
            'sunny' => '☀️ Sunny Day',
            'rainy' => '🌧️ Rainy Day',
            'windy' => '🌬️ Windy Day',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 9 — Speaking
    // ══════════════════════════════════════════════════════════════════════════
    'activity_9' => [
        'title'          => 'Speaking',
        'subtitle'       => 'Arrange the Sentence — Tap the words in the right order to build a sentence',
        'build_sentence' => 'Build your sentence here',
        'word_cards'     => 'Word cards — Drag to place',
        'words' => [
            'going'  => 'going',
            'school' => 'school',
            'to'     => 'to',
            'like'   => 'like',
            'i'      => 'I',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACTIVITY 10 — Gesture-Based
    // ══════════════════════════════════════════════════════════════════════════
    'activity_10' => [
        'title'    => 'Gesture-Based',
        'subtitle' => 'Look at the gesture and choose what it means.',
        'scene'    => 'Scene',
        'question' => 'What is Rafiq telling the other boy to do?',
        'options' => [
            'come_here' => '🚶 Come here',
            'stop'      => '🛑 Stop',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SUCCESS POP-UP
    // ══════════════════════════════════════════════════════════════════════════
    'success' => [
        'title'       => 'Great Job!',
        'description' => 'You\'ve completed the full assessment',
        'plan_ready'  => 'Your child personalized plan is now ready',
        'activities'  => 'Activities',
        'completed'   => 'Completed',
        'plan_label'  => 'Plan ready',
        'view_btn'    => 'View Personalized Plan',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // LOADING PLAN SCREEN
    // ══════════════════════════════════════════════════════════════════════════
    'loading_plan' => [
        'title'       => 'Your personalized plan',
        'description' => 'Based on your child\'s results, we\'ve created a plan just for them. Designed to support their growth step by step.',
        'steps' => [
            'receiving'     => 'Receiving Responses',
            'analyzing'     => 'Analyzing results',
            'building'      => 'Building activity plan',
            'personalizing' => 'Personalizing for your child',
        ],
        'preparing'   => 'Preparing your plan....',
        'ready'       => 'Your plan is ready ✅',
        'please_wait' => 'Please wait...',
        'go_to_plan'  => 'Go to my plan',
    ],
];