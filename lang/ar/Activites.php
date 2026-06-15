<?php

return [

    // ── Activities (Learning Areas) ───────────────────────
    'activities' => [
        'title'              => 'مناطق التعلم',

        // Filters
        'filter_all'         => 'الكل',
        'filter_in_progress' => 'قيد التنفيذ',
        'filter_not_started' => 'لم يبدأ',

        // Activity count & progress
        'activities_count'   => ':num أنشطة',
        'overall_progress'   => 'التقدم الإجمالي',
        'progress_percent'   => ':percent%',
        'level'              => 'المستوى :num',

        // Empty / onboarding states
        'ready_to_start_title' => 'هل أنت مستعد للبدء؟',
        'ready_to_start_body'  => 'لم تبدأ أي جلسات علاجية بعد. ابدأ بأول قسم وتابع تقدم طفلك خطوة بخطوة.',
        'great_job_title'      => 'عمل رائع!',
        'great_job_body'       => 'لقد أكملت جميع أقسام العلاج المتاحة. استمر وأكمل واحدة تلو الأخرى.',
    ],

    // ── Learning Area Categories ──────────────────────────
    'categories' => [
        'social_communication' => [
            'name'        => 'التواصل الاجتماعي',
            'description' => 'التعبير عن الاحتياجات، وفهم الآخرين، وبناء العلاقات.',
        ],
        'play_motor' => [
            'name'        => 'اللعب والمهارات الحركية',
            'description' => 'التنسيق الحركي الدقيق والإجمالي واللعب البدني.',
        ],
        'sensory_processing' => [
            'name'        => 'المعالجة الحسية',
            'description' => 'التعامل مع المدخلات الحسية وتهيئة بيئات مريحة.',
        ],
        'imitation_learning' => [
            'name'        => 'المحاكاة والتعلم',
            'description' => 'اتباع التعليمات، والمطابقة، والمهارات المعرفية.',
        ],
        'emotional_behavioral' => [
            'name'        => 'الجانب العاطفي والسلوكي',
            'description' => 'إدارة المشاعر، وأساليب التكيف، والتنظيم الذاتي.',
        ],
        'social_stories' => [
            'name'        => 'القصص الاجتماعية',
            'description' => 'مقاطع تمثيل أدوار قصيرة تساعد طفلك على التعلم والتعامل مع مواقف الحياة اليومية.',
        ],
    ],

    // ── Activity List (inside a category) ────────────────
    'activity_list' => [
        // Activity status badges
        'beginner_friendly'    => 'مناسب للمبتدئين',
        'interactive'          => 'تفاعلي',

        // Lock/unlock
        'locked'               => 'مقفل',

        // Buttons
        'start_activity'       => 'ابدأ النشاط',
        'continue_activity'    => 'متابعة النشاط',
        'start_activity_again' => 'ابدأ النشاط من جديد',

        // Status labels
        'status_completed'     => 'مكتمل',
        'status_in_progress'   => 'قيد التنفيذ',
        'status_not_started'   => 'لم يبدأ',
    ],

    // ── Social Stories ────────────────────────────────────
    'social_stories' => [
        'title'                => 'القصص الاجتماعية',
        'search_placeholder'   => 'ابحث في القصص الاجتماعية...',

        // Category filters
        'filter_all'           => 'الكل',
        'filter_daily'         => 'الحياة اليومية',
        'filter_communication' => 'التواصل',
        'filter_behavior'      => 'السلوك',

        // Labels
        'all_levels'           => 'جميع المستويات',
        'overall_progress'     => 'التقدم الإجمالي',
    ],

    // ── Story Detail ──────────────────────────────────────
    'story_detail' => [
        'title'           => 'القصة الاجتماعية',
        'script_title'    => 'النص',
        'read_more'       => 'اقرأ المزيد',
        'read_less'       => 'اقرأ أقل',
        'related_stories' => 'قصص ذات صلة',
    ],

    // ── Emotion Train ─────────────────────────────────────
    'emotion_train' => [
        'title'       => 'قطار المشاعر',
        'round'       => 'الجولة :current من :total',
        'instruction' => 'اسحب وأفلت المشاعر خطوة بخطوة على القطار',
        'reset_all'   => 'إعادة تعيين الكل',
        'next'        => 'التالي',

        // Emotion labels
        'emotions' => [
            'sad'       => 'حزين',
            'sleepy'    => 'نعسان',
            'happy'     => 'سعيد',
            'hug'       => 'عناق',
            'breath'    => 'تنفس',
            'upset'     => 'منزعج',
            'calm'      => 'هادئ',
            'nothing'   => 'لا شيء',
            'tired'     => 'متعب',
            'relaxed'   => 'مرتاح',
            'rest'      => 'راحة',
            'shy'       => 'خجول',
            'wave'      => 'تلويح',
            'play'      => 'لعب',
            'angry'     => 'غاضب',
            'nervous'   => 'قلق',
            'confident' => 'واثق',
            'better'    => 'أحسن',
        ],

        // Story sentences
        'stories' => [
            'sad_then_better'        => 'كان رفيق حزيناً، ثم شعر بتحسن',
            'upset_then_calm'        => 'شعر رفيق بالانزعاج، ثم هدأ',
            'tired_needed_rest'      => 'كان رفيق متعباً واحتاج إلى الراحة',
            'shy_made_friend'        => 'كان رفيق خجولاً، ثم أصبح لديه صديق',
            'angry_then_calm'        => 'كان رفيق غاضباً، ثم هدأ',
            'nervous_then_confident' => 'كان رفيق قلقاً، ثم أصبح واثقاً',
        ],

        // Error state
        'error_title' => 'ليس صحيحاً تماماً',
        'error_body'  => 'شاهد المشاعر بعناية، وفكر في كيفية شعور رفيق خطوة بخطوة.',
        'try_again'   => 'حاول مرة أخرى',

        // Completion
        'completed_title' => 'عمل رائع! لقد أكملت النشاط بنجاح',
        'stars_earned'    => 'لقد حصلت على :count نجوم لهذا النشاط!',
        'next_button'     => 'التالي',
    ],

    // ── Emotion Train Feedback ────────────────────────────
    'emotion_train_feedback' => [
        'title'                => 'تقييم قطار المشاعر',
        'session_insights'     => 'رؤى الجلسة',
        'session_insights_body'=> 'دع طفلك يشارك مشاعره وتجربته في النشاط لتحسين جلسات العلاج الشخصية.',

        // Difficulty
        'difficulty_title'    => 'تقييم الصعوبة',
        'difficulty_question' => 'ما مدى صعوبة هذا النشاط؟',
        'easy'                => 'سهل',
        'easy_desc'           => 'أكملته بمساعدة قليلة أو بدون مساعدة.',
        'medium'              => 'متوسط',
        'medium_desc'         => 'كانت بعض الأجزاء صعبة، لكنني نجحت.',
        'hard'                => 'صعب',
        'hard_desc'           => 'وجدته صعباً واحتجت إلى مساعدة.',

        // Mood
        'mood_title'          => 'تقييم المزاج',
        'mood_question'       => 'كيف شعرت أثناء النشاط؟',
        'mood_sub'            => 'اختر المشاعر التي تصف مشاعرك أثناء النشاط.',
        'happy'               => 'سعيد',
        'happy_desc'          => 'استمتعت بهذا النشاط وكان ممتعاً.',
        'calm'                => 'هادئ',
        'calm_desc'           => 'شعرت بالاسترخاء والراحة أثناء إتمامه.',
        'frustrated'          => 'محبط',
        'frustrated_desc'     => 'كانت بعض الأجزاء صعبة وجعلتني أشعر بالإحباط.',

        'submit'              => 'إرسال التقييم',
    ],

];