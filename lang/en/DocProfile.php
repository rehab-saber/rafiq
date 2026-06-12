<?php

return [

    // ══════════════════════════════════════════════════════════════════════════
    // PROFILE 
    // ══════════════════════════════════════════════════════════════════════════
    'profile' => [
        'title'              => 'Profile',
        'team_of_top'        => 'Team of Top',
        'about'              => 'About',
        'specializations'    => 'Specializations',
        'clinic_information' => 'Clinic Information',
        'clinic_name'        => 'Clinic Name: :name',        // ⚠️ DYNAMIC — :name
        'address'            => 'Address',
        'consultation_price' => 'Consultation Price: :price EGP', // ⚠️ DYNAMIC — :price
        'settings'           => 'Settings',
        'settings_sub'       => 'Notifications, Sound & Preferences',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // EDIT PROFILE 
    // ══════════════════════════════════════════════════════════════════════════
    'edit_profile' => [
        'title'              => 'Edit Your Profile',
        'upload_photo'       => 'Upload or Take Photo',
        'notice'             => 'Complete Profile Information',
        'notice_body'        => 'On the Profile page, please make sure to complete all your information clearly and accurately so parents can easily view your details, understand your specialization and experience, and book appointments with confidence.',
        'full_name'          => 'Full Name',               // ⚠️ DYNAMIC — :name
        'specialty'          => 'Specialty',
        'specialty_value'    => 'Child Psychologist',       // ⚠️ DYNAMIC
        'city'               => 'City',
        'city_value'         => 'Suez',                     // ⚠️ DYNAMIC
        'years_of_exp'       => 'Years of Exp.',
        'years_placeholder'  => 'Select your years of experience',
        'about'              => 'About',
        'about_placeholder'  => 'Describe your qualities in detail...',
        'specializations'    => 'Specializations',
        'spec_placeholder_1' => 'Add additional specializations',
        'spec_placeholder_2' => 'Add additional specializations',
        'spec_placeholder_3' => 'Add additional specializations',
        'clinic_information' => 'Clinic Information',
        'clinic_name'        => 'Clinic Name',
        'clinic_name_value'  => 'AmyCare Center',           // ⚠️ DYNAMIC
        'clinic_address'     => 'Clinic address',
        'clinic_addr_placeholder' => 'Your clinic location link or address',
        'save_changes'       => 'Save Changes',

        // Discard dialog
        'discard_title'      => 'Discard changes?',
        'discard_body'       => 'You have unsaved changes. Do you want to save before leaving?',
        'discard_save'       => 'Save',
        'discard_discard'    => 'Discard',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // SETTINGS 
    // ══════════════════════════════════════════════════════════════════════════
    'settings' => [
        'title'                  => 'Settings',

        // Language
        'language'               => 'Language',
        'language_ar'            => 'العربية (مصر)',        // ⚠️ DYNAMIC — selected locale
        'language_en'            => 'English (United Kingdom)', // ⚠️ DYNAMIC — selected locale

        // Notifications
        'notifications'          => 'Notifications',
        'main_notifications'     => 'Main notifications',
        'cancel_alerts'          => 'Cancel of alerts',    // toggle sub-label
        'appointment_reminders'  => 'Appointments reminders',
        'message_alerts'         => 'Message Alerts',
        'progress_alerts'        => 'Progress Alerts',

        // Preferences
        'preferences'            => 'Preferences',
        'online_consultations'   => 'Online Consultations',
        'online_consult_sub'     => 'Allow parents to book online sessions',
        'clinic_visits'          => 'Clinic Visits',
        'clinic_visits_sub'      => 'Allow parents to book clinic visits',
        'chat_status'            => 'Chat Status',
        'chat_status_sub'        => 'Show or hide to parents',

        // Account
        'account'                => 'Account',
        'account_info'           => 'Account Info',
        'account_info_sub'       => 'Name, phone, email',
        'privacy_security'       => 'Privacy & Security',

        // Help & Support
        'help_support'           => 'Help & Support',
        'change_password'        => 'Change Password',
        'privacy_policy'         => 'Privacy Policy',
        'terms_conditions'       => 'Terms & Conditions',
        'contact_support'        => 'Contact Support',
        'contact_support_sub'    => 'Talk to our team for guidance',
        'faq'                    => 'FAQ',
        'faq_sub'                => 'Frequently asked questions',

        'sign_out'               => 'Sign Out',
        'delete_account'         => 'Delete account',

        // Sign Out dialog
        'signout_title'          => 'Are you sure you want to Sign Out?',
        'signout_body'           => 'This will immediately log out of all your active devices.',
        'signout_cancel'         => 'Cancel',
        'signout_confirm'        => 'Yes, Sign Out',

        // Delete Account dialog
        'delete_title'           => 'Are you sure you want to Delete your account?',
        'delete_body'            => 'This action cannot be undone. All your data, patients, and therapy plans will be permanently deleted.',
        'delete_cancel'          => 'Cancel',
        'delete_confirm'         => 'Yes, Delete it',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // ACCOUNT INFO 
    // ══════════════════════════════════════════════════════════════════════════
    'account_info' => [
        'title'          => 'Account Info',
        'name'           => 'Name',
        'name_value'     => 'Dr. Hala Sayed',    // ⚠️ DYNAMIC — :name
        'phone_number'   => 'Phone Number',
        'phone_value'    => '01027224590',        // ⚠️ DYNAMIC — :phone
        'email_address'  => 'Email Address',
        'email_value'    => 'hala@gmail.com',     // ⚠️ DYNAMIC — :email
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // CHANGE PASSWORD 
    // ══════════════════════════════════════════════════════════════════════════
    'change_password' => [
        'title'                => 'Change Password',
        'hint'                 => 'Use a mix of uppercase letters, numbers, and symbols for a stronger password.',
        'current_password'     => 'Current Password',
        'current_placeholder'  => 'Enter your password',
        'new_password'         => 'New Password',
        'new_placeholder'      => 'Enter new password',
        'confirm_password'     => 'Confirm New Password',
        'confirm_placeholder'  => 'Renter new password',
        'submit'               => 'Save Password',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // CONTACT SUPPORT 
    // ══════════════════════════════════════════════════════════════════════════
    'contact_support' => [
        'title'                => 'Contact Support',
        'subtitle'             => 'Talk to our support team for assistance and let us know if something isn\'t working.',
        'full_name'            => 'Full Name',
        'full_name_placeholder'=> 'Enter your full name',   // ⚠️ DYNAMIC — :name
        'email_address'        => 'Email Address',
        'email_placeholder'    => 'Example@gmail.com',      // ⚠️ DYNAMIC — :email
        'subject'              => 'Subject',
        'subject_placeholder'  => 'Select a subject',
        'message'              => 'Message',
        'message_placeholder'  => 'Describe your issue in detail...',
        'upload_screenshot'    => 'Upload Screenshot',
        'upload_optional'      => '(Optional)',
        'upload_placeholder'   => 'Upload a screenshot to help us understand up to 5MB',
        'send_message'         => 'Send Message',
        'privacy_note'         => 'Your messages and treatment plans are only accessible to you and the patient\'s assigned family members.',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // PRIVACY POLICY 
    // ══════════════════════════════════════════════════════════════════════════
    'privacy_policy' => [
        'title'                    => 'Privacy Policy',
        'introduction'             => 'Introduction',
        'introduction_body'        => 'We are fully committed to protecting your privacy and the privacy of your patients. This policy describes how we collect, use, and safeguard your information as a registered doctor on our platform.',
        'data_we_collect'          => 'Data We Collect',
        'data_body'                => 'We collect your professional credentials, license number, clinic address, and availability schedule. Session notes and treatment plans you create are stored securely and linked to your account.',
        'patient_data_protection'  => 'Patient Data Protection',
        'patient_data_body'        => 'All patient data you access through this platform is protected under applicable healthcare privacy laws. You may not share, export, or distribute patient information outside the platform. All data is encrypted at rest and in transit.',
        'communication_privacy'    => 'Communication Privacy',
        'communication_body'       => 'All messages between you and patients\' families are encrypted end-to-end. No third party can access these conversations. You may request a full log of your communication history at any time.',
        'technical_security'       => 'Technical Security',
        'technical_body'           => 'We use SSL/TLS encryption, two-factor authentication, and 24/7 activity monitoring to protect your account and your patients\' data.',
        'account_limitations'      => 'Account Limitations',
        'account_limitations_body' => 'One account per licensed professional. If duplicate accounts or suspicious activity is detected, we reserve the right to suspend or terminate your account pending review.',
        'contact_us'               => 'Contact Us',
        'contact_us_body'          => 'For privacy-related questions, contact us at privacy@custom-support.app. We respond within 48 hours.',
        'general_legal_terms'      => 'General Legal Terms',
        'general_legal_body'       => 'These terms are governed by applicable law. We reserve the right to amend them with prior notice via email or in-app notification.',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // TERMS & CONDITIONS 
    // ══════════════════════════════════════════════════════════════════════════
    'terms_conditions' => [
        'title'                         => 'Terms & Conditions',
        'app_usage_rules'               => 'App Usage Rules',
        'app_usage_body'                => 'By using this platform, you agree to use it solely for legitimate therapeutic consultations with registered patients. Misuse, data manipulation, or unauthorized access is strictly prohibited.',
        'doctor_consultation_policy'    => 'Doctor Consultation Policy',
        'doctor_consultation_body'      => 'You are responsible for the accuracy of all diagnoses, treatment plans, and recommendations you provide. The platform does not override or validate your clinical decisions. You must hold a valid professional license at all times.',
        'doctor_consultation_note'      => 'Each treatment plan and session note you create is tagged with a timestamp and is legally attributable to your account.',
        'appointment_cancellation'      => 'Appointment & Cancellation Policy',
        'appointment_body'              => 'You may cancel a scheduled session up to 24 hours before with no penalty. Cancellations within 24 hours may affect your rating. Repeated no-shows may result in account review.',
        'passcode_responsibilities'     => 'Passcode Responsibilities',
        'passcode_body'                 => 'Passcodes you generate are single-use access credentials tied to specific patients. You are responsible for distributing them securely. Do not share passcodes publicly or with unrelated parties.',
        'account_limitations'           => 'Account Limitations',
        'account_limitations_body'      => 'One account per licensed professional. If duplicate accounts or suspicious activity is detected, we reserve the right to suspend or terminate your account pending review.',
        'general_legal_terms'           => 'General Legal Terms',
        'general_legal_body'            => 'These terms are governed by applicable law. We reserve the right to amend them with prior notice via email or in-app notification.',
    ],

    // ══════════════════════════════════════════════════════════════════════════
    // FAQ SCREEN
    // ══════════════════════════════════════════════════════════════════════════
    'faq' => [
        'title' => 'Frequently Asked Questions',
        'questions' => [
            [
                'q' => 'How do I set my available time slots?',
                'a' => 'Go to the Availability tab in Schedule, select the days you want to work, and set your start and end times. You can also block specific dates for holidays or personal leave.',
            ],
            [
                'q' => 'How do I generate a passcode?',
                'a' => 'Go to Passcodes tab, tap Generate New. You can then copy or share the code directly with the family.',
            ],
            [
                'q' => 'Can I offer both online and in-person sessions?',
                'a' => 'Yes. In your Preferences settings, you can enable or disable online (video call) and in-person (clinic) session types independently. Patients will see both options when booking.',
            ],
            [
                'q' => 'How do I create a treatment plan for a patient?',
                'a' => 'Go to Patients, select the patient, then tap Edit Plan. You can add, modify, or remove goals across different categories. Plans are immediately visible to the patient\'s family.',
            ],
            [
                'q' => 'How do I track a patient\'s progress?',
                'a' => 'Open any patient\'s profile to see a real-time progress breakdown by category. Progress is updated automatically as the family logs completed activities. You can also add written feedback from this view.',
            ],
            [
                'q' => 'What happens if a patient misses a session?',
                'a' => 'The session is marked as missed in your schedule. You can reschedule directly from the appointment card or send a message to the family through the chat feature.',
            ],
            [
                'q' => 'How do I message a patient\'s family?',
                'a' => 'Open the patient\'s profile and tap Message Parent, or go to the chat icon in the appointment card. All messages are encrypted and stored securely.',
            ],
            [
                'q' => 'How do I turn notifications on or off?',
                'a' => 'Go to Settings > Notifications where you can enable or disable reminders for activities, doctor appointments, messages, and weekly reports.',
            ],
            [
                'q' => 'Can I change the app language?',
                'a' => 'Yes. Open Settings > Language and choose between Arabic and English.',
            ],
            [
                'q' => 'What if I forget my password?',
                'a' => 'You can reset your password by tapping on "Forgot Password" on the login screen and following the instructions sent to your registered email.',
            ],
            [
                'q' => 'How can I provide feedback about the app?',
                'a' => 'You can submit feedback through the Help & Support section, where you\'ll find an option to send suggestions or report your experience to our team.',
            ],
        ],
    ],

];