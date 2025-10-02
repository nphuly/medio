<?php

/**
 * @author  lpn
 * @ticket
 */

return [
    'patient' => [
        'translation' => 'Patient',
        'translation_plural' => 'Patients',
        'navigation_group' => 'Patients',
        'fields' => [
            'first_name' => 'First name',
            'middle_name' => 'Middle name',
            'last_name' => 'Last name',
            'full_name' => 'Full name',
            'email' => 'Email',
            'dob' => 'Date of birth',
            'gender' => 'Gender',
            'medical_history' => 'Medical history',
            'background_condition' => 'Background condition',
            'background_condition_note' => 'Notes'
        ],
        'actions' => [
            'add_patient' => 'Add patient',
        ]
    ],

    'doctor' => [
        'translation' => 'Doctor',
        'translation_plural' => 'Doctors',
        'fields' => [
            'first_name' => 'First name',
            'middle_name' => 'Middle name',
            'last_name' => 'Last name',
            'full_name' => 'Full name',
            'email' => 'Email',
            'dob' => 'Date of birth',
            'gender' => 'Gender',
            'speciality' => 'Speciality',
            'work_schedule' => 'Work Schedule',
        ],
        'actions' => [
            'add_doctor' => 'Add doctor',
        ],
        'work_schedule' => [
            'day' => 'Day',
            'start_time' => 'Start time',
            'end_time' => 'End time',
        ]
    ],

    'settings' => [
        'weekdays' => [
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
            'sunday' => 'Sunday',
        ],
        'genders' => [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other'
        ],
        'statuses' => [
            'scheduled' => 'Scheduled',
            'confirmed' => 'Confirmed',
            'checked_in' => 'Checked in',
            'in_progress' => 'In progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'not_informed' => 'Not coming, but not informed',
            'rescheduled' => 'Rescheduled',
        ],
        'priorities' => [
            'low' => 'No urgency/periodic re -examination',
            'medium' => 'Normal examination schedule',
            'high' => 'High priority, should arrange early'
        ],
        'labels' => [
            'appointment_information' => 'Appointment Information',
            'patient_information' => 'Patient Information',
            'doctor_information' => 'Doctor Information',
        ],
        'schedule_navigation_group' => 'Schedule',
        'internal_navigation_group' => 'Internal',
        'no_information' => 'No information',
    ],

    'phones' => [
        'translation' => 'Phone',
        'translation_plural' => 'Phones',
        'fields' => [
            'phone_type' => 'Type',
            'phone_number' => 'Phone number',
            'is_main' => 'Is main?',
        ],
        'types' => [
            'mobile' => 'Mobile',
            'work' => 'Work',
            'fax' => 'Fax',
            'landline' => 'Landline',
        ],
        'actions' => [
            'add_new_phone' => 'Add new phone'
        ],
    ],

    'addresses' => [
        'translation' => 'Address',
        'translation_plural' => 'Addresses',
        'fields' => [
            'address_type' => 'Type',
            'address_line_1' => 'Address line 1',
            'address_line_2' => 'Address line 2',
            'city' => 'City',
            'region' => 'Region',
            'postal_code' => 'Postal Code',
            'country' => 'Country',
        ],
        'types' => [
            'home' => 'Home',
            'office' => 'Office'
        ],
        'actions' => [
            'add_new_address' => 'Add new address'
        ],
    ],

    'appointments' => [
        'translation' => 'Appointment',
        'translation_plural' => 'Appointments',
        'fields' => [
            'patient' => 'Patient',
            'appointment_datetime' => 'Appointment Datetime',
            'checked_in_at' => 'Checked in at',
            'status' => 'Status',
            'priority' => 'Priority',
            'cancellation_reason' => 'Cancellation Reason',
            'comment' => 'Comment',
            'request_for_examination' => 'Request for examination',
        ],
        'actions' => [
            'confirm' => 'Confirm',
            'check_in_appointment' => 'Check in',
            'cancel_appointment' => 'Cancel',
            'patient_not_coming' => 'Not Coming',
            'schedule_appointment' => 'Schedule Appointment',
        ],
        'filters' => [
            'month' => 'By month',
            'date' => 'By date'
        ],
        'notifications' => [
            'appointment_is_cancelled' => 'Appointment is cancelled!',
        ]
    ],

    'medical_conditions' => [
        'translation' => 'Medical Condition',
        'translation_plural' => 'Medical Conditions',
        'fields' => [
            'code' => 'Code',
            'name' => 'Name',
            'description' => 'Description',
        ],
        'actions' => [
            'add_new_medical_condition' => 'Add medical condition',
        ]
    ],

    'visits' => [
        'translation' => 'Visit',
        'translation_plural' => 'Visits',
        'fields' => [
            'visit_date' => 'Start examining at',
            'symptoms' => 'Symptoms',
            'diagnosis' => 'Diagnosis',
            'treatment' => 'Treatment',
            'notes' => 'Notes',
            'comeback_date' => 'Comeback date',
            'status' => 'Status',
            'appointment_datetime' => 'Appointment Datetime',
            'patient' => 'Patient',
            'doctor' => 'Doctor',
            'examination_type' => 'Examination type',
        ],
        'actions' => [
            'add_visit' => 'Add visit',
        ]
    ],

    'charts' => [
        'appointments_per_month' => [
            'heading' => 'Appointments in this month',
            'datasets' => [
                'number_of_appointments' => 'Number of completed appointments',
            ]
        ],
        'appointments_per_week' => [
            'heading' => 'Appointments in this week',
            'datasets' => [
                'number_of_appointments' => 'Number of completed appointments',
            ]
        ]
    ],

    'stats_widgets' => [
        'stats_overview' => [
            'heading' => 'Stats overview',
            'stats' => [
                'sum_of_patients' => [
                    'label' => 'Number of patients',
                    'description' => 'Up to the present',
                ],
                'sum_of_doctors' => [
                    'label' => 'Number of doctors',
                    'description' => 'Up to the present',
                ],
                'sum_of_completed_appointments_today' => [
                    'label' => 'Number of completed appointments today',
                    'description' => 'On ',
                ],
                'sum_of_completed_appointments_this_week' => [
                    'label' => 'Number of completed appointments this week',
                    'description' => 'From ',
                ]
            ]
        ]
    ]
];
