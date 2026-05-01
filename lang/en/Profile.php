<?php

return [

    // ── Profile ──────────────────────────────────────────
    'profile' => [
        'title'              => 'Profile',
        'age'                => ':age years old',
        'joined'             => 'Joined :date',
        'level'              => 'Level :num',
        'progressing'        => 'Progressing',

        'settings'           => 'Settings',
        'settings_sub'       => 'Notifications, Sound & Preferences',

        'articles'           => 'Awareness Articles',
        'articles_sub'       => 'Tips & guides for parents',

        'test_result'        => 'Test Result',
        'test_result_sub'    => 'View test results (CARS & Lovaas)',

        'emergency'          => 'Emergency Contact',
        'sign_out'           => 'Sign Out',
    ],

    // ── Settings ─────────────────────────────────────────
    'settings' => [
        'title'              => 'Settings',

        'language'           => 'Language',
        'lang_arabic'        => 'العربية (مصر)',
        'lang_english'       => 'English (United Kingdom)',

        'notifications'      => 'Notifications',
        'main_notif'         => 'Main notifications',
        'main_notif_sub'     => 'Control all alerts',
        'activity_reminders' => 'Activity reminders',
        'appt_reminders'     => 'Appointments reminders',
        'doctor_messages'    => 'Doctor messages',
        'article_reminder'   => 'New article reminder',

        'sound_vibration'    => 'Sound & Vibration',
        'sound_effects'      => 'Sound Effects',
        'vibration'          => 'Vibration',

        'session_goal'       => 'Daily Session Goal',
        'min'                => 'Min',

        'privacy_security'   => 'Privacy & Security',
        'change_password'    => 'Change Password',
        'privacy_policy'     => 'Privacy Policy',
        'privacy_policy_sub' => 'How we protect your data',
        'terms'              => 'Terms & Conditions',
        'terms_sub'          => 'Usage rules and legal policies',

        'help_support'       => 'Help & Support',
        'contact_support'    => 'Contact Support',
        'contact_support_sub'=> 'Talk to our support team for assistance',
        'faq'                => 'FAQ',
        'faq_sub'            => 'Frequently asked questions',
    ],

    // ── Change Password ───────────────────────────────────
    'change_password' => [
        'title'              => 'Change Password',
        'hint'               => 'Use a mix of uppercase letters, numbers, and symbols for a stronger password.',
        'current'            => 'Current Password',
        'current_hint'       => 'Enter your password',
        'new'                => 'New Password',
        'new_hint'           => 'Enter new password',
        'confirm'            => 'Confirm New Password',
        'confirm_hint'       => 'Renter new password',
        'submit'             => 'Update Password',
    ],

    // ── Privacy Policy ────────────────────────────────────
    'privacy_policy' => [
        'title'              => 'Privacy Policy',
        'intro_title'        => 'Introduction',
        'intro_body'         => 'We are fully committed to protecting your privacy and your child\'s privacy. This policy describes how we collect, use, and safeguard your information when you use our app.',
        'data_title'         => 'Data We Collect',
        'data_body'          => 'We collect information you voluntarily provide when creating your account, including your name, email address, phone number, and your child\'s health information. We also collect usage data to improve your experience.',
        'child_title'        => 'Child Data Protection',
        'child_body'         => 'We place the highest priority on protecting children\'s data. We never share any information about your child with third parties without your explicit consent. All data is stored with full encryption and is only accessible to the treating doctor and parents.',
        'comm_title'         => 'Communication Privacy',
        'comm_body'          => 'All conversations between parents and doctors are encrypted and protected. No third party can access these conversations. You have the right to request deletion of your conversation history at any time.',
        'security_title'     => 'Technical Security',
        'security_body'      => 'We use advanced security protocols to protect your data, including SSL/TLS encryption, two-factor authentication, and 24/7 suspicious activity monitoring.',
        'contact_title'      => 'Contact Us',
        'contact_body'       => 'If you have any questions about this privacy policy, contact us at privacy@autism-support.app and we will respond within 48 hours.',
    ],

    // ── Terms & Conditions ────────────────────────────────
    'terms' => [
        'title'              => 'Terms & Conditions',
        'usage_title'        => 'App Usage Rules',
        'usage_body'         => 'By using this app, you agree to use it for lawful purposes only. Publishing misleading or abusive content, use, and attempting unauthorized access to other users\' data.',
        'doctor_title'       => 'Doctor Consultation Policy',
        'doctor_body'        => 'Content provided in the app is for informational purposes only and does not replace professional medical consultation. All registered doctors are qualified and licensed. Each doctor bears responsibility for their diagnosis and treatment decisions.',
        'booking_title'      => 'Booking Cancellation Policy',
        'booking_body'       => 'You may cancel an appointment free of charge up to 24 hours before the scheduled time. Cancellations made less than 24 hours in advance may incur a nominal fee. No-shows without prior notice will be charged in full.',
        'user_title'         => 'User Responsibilities',
        'user_body'          => 'You are responsible for maintaining the confidentiality of your account credentials and password. Please notify us immediately if you suspect any unauthorized access. You are also responsible for the accuracy of information you provide.',
        'account_title'      => 'Account Limitations',
        'account_body'       => 'One user account is permitted. If duplicate accounts or suspicious activity is detected, we reserve the right to suspend or terminate the account. You may add multiple child profiles within a single account.',
        'legal_title'        => 'General Legal Terms',
        'legal_body'         => 'These terms are governed by applicable law. We reserve the right to amend these terms with prior notice via email or in-app notifications.',
    ],

    // ── Contact Support ───────────────────────────────────
    'contact_support' => [
        'title'              => 'Contact Support',
        'hint'               => 'Talk to our support team for assistance and let us know if something isn\'t working',
        'full_name'          => 'Full Name',
        'full_name_hint'     => 'Enter your full name',
        'email'              => 'Email Address',
        'email_hint'         => 'Example@gmail.com',
        'subject'            => 'Subject',
        'subject_hint'       => 'Select a subject',
        'message'            => 'Message',
        'message_hint'       => 'Describe your issue in detail...',
        'upload'             => 'Upload Screenshot (Optional)',
        'upload_desc'        => 'Upload a screenshot to help us understand - up to 5MB',
        'send_btn'           => 'Send Message',
    ],

    // ── FAQ ───────────────────────────────────────────────
    'faq' => [
        'title'              => 'Frequently Asked Questions',

        'q1'  => 'Can I use the app without a doctor?',
        'a1'  => 'Yes. Parents can complete onboarding, take the CARS and Lovaas assessments, and receive a customized activity plan without doctor assignment.',

        'q2'  => 'How do I book a doctor consultation?',
        'a2'  => 'Go to the Doctors tab, browse available doctors, select a doctor profile, choose an available time slot, and confirm your booking.',

        'q3'  => 'How is my child\'s progress calculated?',
        'a3'  => 'Progress is based on completed activities, consistency (day streak), rewards earned, and doctor feedback when available. You can view detailed charts in the "Progress" section.',

        'q4'  => 'Can I chat with my child\'s doctor?',
        'a4'  => 'Yes. If your child is assigned to a doctor, you can use the in-app chat feature to send messages, ask questions, and receive guidance.',

        'q5'  => 'Can I edit my child\'s profile information?',
        'a5'  => 'Yes. Open the Profile section, select Child Profile, then tap Edit to update information like age or personal details.',

        'q6'  => 'What happens after I complete an activity?',
        'a6'  => 'The activity status changes to Done, your child\'s progress updates automatically, and rewards or streaks may increase.',

        'q7'  => 'How do I turn notifications on or off?',
        'a7'  => 'Go to Settings > Notifications where you can enable or disable reminders for activities, doctor appointments, messages, and weekly reports.',

        'q8'  => 'What should I do if an activity is not loading?',
        'a8'  => 'Go to Help & Support > Report a Problem and submit the issue with details or a screenshot so our support team can assist you.',

        'q9'  => 'Can I change the app language?',
        'a9'  => 'Yes. Open Settings > Language and choose between Arabic and English.',

        'q10' => 'How do rewards and streaks work?',
        'a10' => 'Your child earns rewards for completing activities and maintains a streak by staying consistent with daily tasks. This helps encourage motivation and progress.',

        'q11' => 'How do I view test results (CARS & Lovaas)?',
        'a11' => 'Go to the Profile tab, then open Test Results to see your child\'s CARS score, autism level, and Lovaas assessment summary.',

        'q12' => 'What if I forget my password?',
        'a12' => 'You can reset your password by tapping on "Forgot Password?" on the login screen and following the instructions sent to your registered email.',

        'q13' => 'How can I provide feedback about the app?',
        'a13' => 'You can submit feedback through the Help & Support section, where you\'ll find an option to send suggestions or report your experience to our team.',
    ],

    // ── Test Results ──────────────────────────────────────
    'test_result' => [
        'title'              => 'Test Results',
        'cars_result'        => 'Cars Result',
        'lovaas_result'      => 'Lovaas Result',
        'total_score'        => 'Total Score',
        'out_of'             => 'Out of :max points',
        'interpretation'     => 'Interpretation',
        'guide_title'        => 'Score Interpretation Guide',

        'no_autism'          => 'No signs of autism',
        'mild_autism'        => 'Mild Autism',
        'moderate_autism'    => 'Moderate Autism',
        'severe_autism'      => 'Severe Autism',

        'lovaas_pass'        => 'For sections that are performed correctly, they will be included in the treatment plan',
        'lovaas_fail'        => 'For sections that are not performed correctly, it will be included in the treatment plan',

        'social'             => 'Social Interaction',
        'gesture'            => 'Gesture-Based',
        'speaking'           => 'Speaking',
        'visual'             => 'Visual Sense',
        'flexibility'        => 'Flexibility & Routine',
        'auditory'           => 'Auditory Sense',
        'body'               => 'Body Use',
        'object'             => 'Object Use',
        'imitation'          => 'Imitation',
        'emotional'          => 'Emotional Response',
    ],

    // ── Edit Child Profile ────────────────────────────────
    'edit_child' => [
        'title'              => 'Edit Child Profile',
        'upload_photo'       => 'Upload or Take Photo',
        'child_name'         => 'Child Name',
        'child_age'          => 'Child Age',
        'update_btn'         => 'Update',
    ],

    // ── Sign Out Modal ────────────────────────────────────
    'signout' => [
        'title'              => 'Are you sure you want to Sign Out?',
        'description'        => 'This will immediately log out all your active devices.',
        'cancel'             => 'Cancel',
        'confirm'            => 'Yes, Sign Out',
    ],

];