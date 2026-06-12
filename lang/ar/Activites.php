<?php

return [

    // ── النشاطات (مناطق التعلم) ───────────────────────────
    'activities' => [
        'title'              => 'مناطق التعلم',

        // الفلاتر
        'filter_all'         => 'الكل',
        'filter_in_progress' => 'جارية',
        'filter_not_started' => 'لم تبدأ',

        // عدد النشاطات والتقدم
        'activities_count'   => ':num نشاط',
        'overall_progress'   => 'التقدم الكلي',
        'progress_percent'   => ':percent%',
        'level'              => 'المستوى :num',
    ],

    // ── تصنيفات مناطق التعلم ──────────────────────────────
    'categories' => [
        'social_communication' => [
            'name'        => 'التواصل الاجتماعي',
            'description' => 'التعبير عن الاحتياجات وفهم الآخرين وبناء العلاقات.',
        ],
        'play_motor' => [
            'name'        => 'اللعب والمهارات الحركية',
            'description' => 'تنسيق الحركة الكبيرة والدقيقة واللعب البدني.',
        ],
        'sensory_processing' => [
            'name'        => 'المعالجة الحسية',
            'description' => 'التعامل مع المدخلات الحسية وخلق بيئات مريحة.',
        ],
        'imitation_learning' => [
            'name'        => 'المحاكاة والتعلم',
            'description' => 'اتباع التعليمات والمطابقة والمهارات المعرفية.',
        ],
        'emotional_behavioral' => [
            'name'        => 'العاطفة والسلوك',
            'description' => 'إدارة المشاعر واستراتيجيات التكيف وضبط النفس.',
        ],
        'social_stories' => [
            'name'        => 'القصص الاجتماعية',
            'description' => 'مقاطع قصيرة تساعد طفلك على التعلم والتعامل مع مواقف الحياة.',
        ],
    ],

    // ── قائمة النشاطات (داخل تصنيف) ─────────────────────
    'activity_list' => [
        // شارات حالة النشاط
        'beginner_friendly'  => 'مناسب للمبتدئين',
        'interactive'        => 'تفاعلي',

        // قفل/فتح
        'locked'             => 'مقفل',

        // الأزرار
        'start_activity'         => 'ابدأ النشاط',
        'continue_activity'      => 'تابع النشاط',
        'start_activity_again'   => 'ابدأ النشاط مجدداً',

        // حالات النشاط
        'status_completed'   => 'مكتمل',
        'status_in_progress' => 'جاري',
        'status_not_started' => 'لم يبدأ',
    ],

    // ── القصص الاجتماعية ──────────────────────────────────
    'social_stories' => [
        'title'              => 'القصص الاجتماعية',
        'search_placeholder' => 'ابحث في القصص الاجتماعية...',

        // فلاتر التصنيف
        'filter_all'         => 'الكل',
        'filter_daily'       => 'الحياة اليومية',
        'filter_communication' => 'التواصل',
        'filter_behavior'    => 'السلوك',

        // تسميات
        'all_levels'         => 'جميع المستويات',
        'overall_progress'   => 'التقدم الكلي',
    ],

    // ── تفاصيل القصة ─────────────────────────────────────
    'story_detail' => [
        'title'              => 'القصة الاجتماعية',
        'script_title'       => 'النص',
        'read_more'          => 'اقرأ المزيد',
        'read_less'          => 'اقرأ أقل',
        'related_stories'    => 'قصص مشابهة',
    ],

];