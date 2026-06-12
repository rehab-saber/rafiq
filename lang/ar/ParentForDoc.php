<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // PATIENTS LIST 
    // ══════════════════════════════════════════════════════════════════════════
    'patients' => [
        'title'              => 'المرضى',
        'search_placeholder' => 'ابحث باسم الطفل...',

        // Filter tabs
        'filter' => [
            'all'          => 'الكل',
            'active'       => 'نشط',
            'needs_review' => 'يحتاج مراجعة',
        ],

        // Patient card
        'overall_progress' => 'التقدم العام',
        'last_activity'    => 'آخر نشاط',               // ⚠️ DYNAMIC — منذ :time

        // Status badges
        'status' => [
            'active'       => 'نشط',
            'needs_review' => 'يحتاج مراجعة',
        ],

        // Empty states
        'empty_no_patients'     => 'أضف مريضك الأول لتبدأ في متابعة رحلته العلاجية',
        'add_patients_btn'      => '+ إضافة مرضى',

        'empty_no_plan'         => 'سيظهر المرضى هنا بمجرد امتلاكهم خطة علاجية جارية',

        'empty_no_review'       => 'لا يوجد مرضى يحتاجون مراجعة الآن. استمر في العمل الرائع!',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PATIENT PROFILE 
    // ══════════════════════════════════════════════════════════════════════════
    'patient_profile' => [
        'title'          => 'ملف المريض',
        'parent_role'    => 'دور ولي الأمر',             // ⚠️ DYNAMIC

        // Action buttons
        'message'        => 'مراسلة',
        'edit_plan'      => 'تعديل الخطة',
        'make_plan'      => 'إنشاء خطة',

        // Tabs
        'tabs' => [
            'overview'      => 'نظرة عامة',
            'therapy_plan'  => 'الخطة العلاجية',
        ],

        // ── OVERVIEW TAB ──────────────────────────────────────────────────
        'overall_progress'     => 'التقدم العام',
        'overall_progress_sub' => 'بناءً على الأنشطة المنزلية المكتملة',  // ⚠️ DYNAMIC — :percent%

        'activity_this_week'   => 'نشاط هذا الأسبوع',
        'no_activities_week'   => 'لا توجد أنشطة هذا الأسبوع بعد',
        'no_activities_sub'    => 'بمجرد إتمام مريضك للأنشطة، سيظهر تقدمه الأسبوعي هنا',
        'make_plan_btn'        => 'إنشاء خطة',

        // Days of week (chart x-axis)
        'days' => [
            'mon' => 'إثن',
            'sat' => 'سبت',
            'sun' => 'أحد',
            'tue' => 'ثلا',
            'wed' => 'أرب',
            'thu' => 'خمي',
        ],

        'monthly_progress'     => 'التقدم الشهري',
        'assign_activities'    => 'أضف أنشطة لترى التقدم',
        'assign_activities_sub'=> 'بمجرد إتمام مريضك للأنشطة، سيظهر تقدمه الشهري هنا',

        // Weeks (chart x-axis)
        'weeks' => [
            'week_1' => 'الأسبوع 1',
            'week_2' => 'الأسبوع 2',
            'week_3' => 'الأسبوع 3',
            'week_4' => 'الأسبوع 4',
        ],

        'activity_mood_tracker'     => 'متتبع مزاج النشاط',
        'mood_tracker_sub'          => 'بناءً على الجلسات المكتملة للطفل',
        'no_mood_yet'               => 'لا توجد بيانات مزاج بعد',
        'no_mood_yet_sub'           => 'سيظهر تتبع المزاج بعد إتمام مريضك لأول جلسة',

        // Mood labels
        'moods' => [
            'gold'      => 'ممتاز',
            'happy'     => 'سعيد',
            'calm'      => 'هادئ',
            'frustrated'=> 'محبط',
        ],

        // Difficulty levels
        'difficulty' => [
            'easy'   => 'سهل',
            'medium' => 'متوسط',
            'hard'   => 'صعب',
        ],

        // Mood chart legend
        'mood_legend' => [
            'calm'      => 'هادئ — تنخفض النسبة كلما زادت صعوبة الأنشطة',
            'frustrated'=> 'محبط — يرتفع عند الأنشطة الصعبة',
        ],

        'skills_development'   => 'تطوير المهارات',
        'skills' => [
            'talking_connecting' => 'التواصل والتفاعل',
            'moving_feeling'     => 'الحركة والإحساس',
            'focus_learning'     => 'التركيز والتعلم',
            'feelings_calm'      => 'المشاعر والهدوء',
        ],

        'download_full_report' => 'تحميل التقرير الكامل',

        // ── THERAPY PLAN TAB ──────────────────────────────────────────────
        'therapy_plan' => [
            'social_communication'   => 'التواصل الاجتماعي',
            'social_comm_sub'        => 'التعبير عن الاحتياجات وفهم الآخرين وبناء العلاقات.',
            'play_motor_skills'      => 'اللعب والمهارات الحركية',
            'play_motor_sub'         => 'التنسيق الحركي الكبير والدقيق واللعب البدني.',
            'sensory_processing'     => 'المعالجة الحسية',
            'sensory_sub'            => 'التعامل مع المدخلات الحسية وخلق بيئات مريحة.',
            'imitation_learning'     => 'المحاكاة والتعلم',
            'imitation_sub'          => 'اتباع التعليمات والمطابقة والمهارات المعرفية.',
            'emotional_behavioral'   => 'السلوك والعواطف',
            'emotional_sub'          => 'إدارة المشاعر واستراتيجيات التكيف والتنظيم الذاتي.',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // BUILD PLAN 
    // ══════════════════════════════════════════════════════════════════════════
    'build_plan' => [
        'title'       => 'إنشاء خطة',
        'notice'      => 'إنشاء خطط مخصصة',
        'notice_body' => 'داخل كل قسم، يمكنك اختيار المستوى المناسب وتحديد الأنشطة التي تريد تضمينها في خطة الطفل.',

        // Categories
        'categories' => [
            'social_communication' => 'التواصل الاجتماعي',
            'play_motor_skills'    => 'اللعب والمهارات الحركية',
            'sensory_processing'   => 'المعالجة الحسية',
            'imitation_learning'   => 'المحاكاة والتعلم',
            'emotional_behavioral' => 'السلوك والعواطف',
        ],

        // Levels
        'levels' => [
            'level_1' => 'المستوى 1',
            'level_2' => 'المستوى 2',
            'level_3' => 'المستوى 3',
            'level_4' => 'المستوى 4',
        ],

        'save_changes' => 'حفظ التغييرات',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SOCIAL & COMMUNICATION  (Activity selection inside Build Plan)
    // ══════════════════════════════════════════════════════════════════════════
    'social_communication' => [
        'title'               => 'التواصل الاجتماعي',
        'selected_activities' => 'الأنشطة المحددة',      // ⚠️ DYNAMIC — :count

        // Activities list
        'activities' => [
            'eye_contact_game'         => 'لعبة التواصل البصري',
            'turn_taking_with_toys'    => 'المناوبة في اللعب بالألعاب',
            'emotion_recognition_cards'=> 'بطاقات التعرف على المشاعر',
            'group_interaction'        => 'التفاعل الجماعي',
            'expressing_feelings'      => 'التعبير عن المشاعر',
            'question_answer_practice' => 'تدريب السؤال والجواب',
        ],

        'save_changes' => 'حفظ التغييرات',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PLAY & MOTOR SKILLS 
    // ══════════════════════════════════════════════════════════════════════════
    'play_motor_skills' => [
        'title'           => 'اللعب والمهارات الحركية',
        'overall_progress'=> 'التقدم العام',              // ⚠️ DYNAMIC — :percent%

        // Activities
        'activities' => [
            'greeting_others'      => 'تحية الآخرين',
            'asking_for_help'      => 'طلب المساعدة',
            'turn_taking'          => 'المناوبة',
            'identifying_emotions' => 'التعرف على المشاعر',
            'eye_contact_game'     => 'لعبة التواصل البصري',
            'sharing_toys'         => 'مشاركة الألعاب',
        ],
    ],

];