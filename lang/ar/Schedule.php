<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // SCHEDULE  — TABS
    // ══════════════════════════════════════════════════════════════════════════
    'tabs' => [
        'appointments' => 'المواعيد',
        'availability'  => 'التوافر',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SCHEDULE  — APPOINTMENTS TAB
    // ══════════════════════════════════════════════════════════════════════════
    'appointments' => [
        'reservation_notice'     => 'المواعيد طلبات حجز فقط',
        'reservation_notice_body'=> 'يتم الدفع والتأكيد مباشرةً عبر العيادة. تواصل مع ولي الأمر قبل إنهاء أي موعد.',

        'new_requests'           => ':count طلبات جديدة',                      // ⚠️ DYNAMIC — :count
        'new_requests_sub'       => 'لديك :count طلبات مواعيد جديدة تحتاج إلى مراجعتك.', // ⚠️ DYNAMIC — :count
        'view'                   => 'عرض >',

        'upcoming_appointments'  => 'المواعيد القادمة',

        // Days of week (calendar strip)
        'days' => [
            'mon' => 'إثن',
            'tue' => 'ثلا',
            'wed' => 'أرب',
            'thu' => 'خمي',
            'fri' => 'جمع',
        ],

        // Appointment status badges
        'status' => [
            'completed' => 'مكتمل',
            'upcoming'  => 'قادم',
            'in_clinic' => 'في العيادة',
            'online'    => 'أونلاين',
            'cancelled' => 'ملغي',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PATIENT INFO  (from Schedule)
    // ══════════════════════════════════════════════════════════════════════════
    'patient_info' => [
        'title'           => 'معلومات المريض',
        'age_started'     => ':age سنوات · بدأ في :date',         // ⚠️ DYNAMIC — :age, :date
        'level'           => 'المستوى :level',                     // ⚠️ DYNAMIC — :level
        'progressing'     => 'في تقدّم',

        'appointment_info'=> 'معلومات الموعد',
        'date_time'       => 'التاريخ والوقت',
        'location'        => 'الموقع',
        'online_consult'  => 'استشارة أونلاين',
        'clinic_visit'    => 'زيارة عيادة',
        'parent_note'     => 'ملاحظة ولي الأمر:',                  // ⚠️ DYNAMIC — free text from parent

        // Child's Cars Result
        'cars_result'         => 'نتيجة مقياس CARS للطفل',
        'total_score'         => 'الدرجة الإجمالية',
        'out_of'              => 'من :total درجة',                 // ⚠️ DYNAMIC — :total
        'interpretation'      => 'التفسير',

        // Score Interpretation Guide
        'score_guide'         => 'دليل تفسير الدرجات',
        'score_ranges' => [
            'no_autism'       => 'لا توجد علامات على التوحد',
            'mild_autism'     => 'توحد خفيف',
            'moderate_autism' => 'توحد متوسط',
            'severe_autism'   => 'توحد شديد',
        ],
        'score_labels' => [
            'range_1' => '15 - 26.5 درجة',
            'range_2' => '27 - 35.5 درجة',
            'range_3' => '36 - 47.5 درجة',
            'range_4' => '48 - 60 درجة',
        ],
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // APPOINTMENT REQUESTS 
    // ══════════════════════════════════════════════════════════════════════════
    'appointment_requests' => [
        'title'           => 'طلبات المواعيد',

        'date_time'       => 'التاريخ والوقت',
        'location'        => 'الموقع',
        'clinic_visit'    => 'زيارة عيادة',
        'online'          => 'أونلاين',
        'parent_note'     => 'ملاحظة ولي الأمر:',                  // ⚠️ DYNAMIC — free text

        'confirm'         => 'تأكيد',
        'reject'          => 'رفض',

        // Reject dialog
        'reject_title'    => 'هل أنت متأكد أنك تريد رفض طلب الموعد هذا؟',
        'reject_body'     => 'سيتم إشعار ولي الأمر بأن طلب الموعد قد تم رفضه.',
        'reject_cancel'   => 'إلغاء',
        'reject_confirm'  => 'نعم، ارفضه',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // AVAILABILITY TAB
    // ══════════════════════════════════════════════════════════════════════════
    'availability' => [
        'manage_notice'       => 'إدارة التوافر',
        'manage_notice_body'  => 'تحكم في مواعيدك عن طريق الضغط على أي يوم لفتحه للحجز وتحديد الأوقات المتاحة لديك.',

        // Calendar legend
        'legend' => [
            'today'     => 'اليوم',
            'available' => 'متاح',
            'selected'  => 'محدد',
        ],

        'selected_day'        => 'اليوم المحدد',                   // ⚠️ DYNAMIC — :date

        'available_today'     => 'متاح اليوم',
        'available_today_sub' => 'يمكن لأولياء الأمور حجز مواعيد.',
        'day_closed'          => 'هذا اليوم مغلق',
        'day_closed_sub'      => 'لا يمكن لأولياء الأمور حجز مواعيد. فعّل خيار التوافر لضبط الأوقات المتاحة.',

        'time_availability'   => 'أوقات التوافر',
        'add_slot'            => '+',                              // زر إضافة وقت

        // Delete time slot dialog
        'delete_slot_title'   => 'حذف الفترة الزمنية',
        'delete_slot_save'    => 'حفظ',
        'delete_slot_cancel'  => 'إلغاء',
    ],

];