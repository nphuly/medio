<?php

/**
 * @author  lpn
 * @ticket
 */

return [
    'patient' => [
        'translation' => 'Bệnh nhân',
        'translation_plural' => 'Bệnh nhân',
        'navigation_group' => 'Bệnh nhân',
        'fields' => [
            'first_name' => 'Tên',
            'middle_name' => 'Tên lót',
            'last_name' => 'Họ',
            'full_name' => 'Tên đầy đủ',
            'email' => 'Email',
            'dob' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'medical_history' => 'Lịch sử bệnh/Bệnh nền',
            'background_condition' => 'Bệnh nền',
            'background_condition_note' => 'Ghi chú'
        ],
        'actions' => [
            'add_patient' => 'Thêm bệnh nhân',
        ]
    ],

    'doctor' => [
        'translation' => 'Bác sĩ',
        'translation_plural' => 'Bác sĩ',
        'fields' => [
            'first_name' => 'Tên',
            'middle_name' => 'Tên lót',
            'last_name' => 'Họ',
            'full_name' => 'Tên đầy đủ',
            'email' => 'Email',
            'dob' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'speciality' => 'Chuyên môn',
            'work_schedule' => 'Thời gian làm việc'
        ],
        'actions' => [
            'add_doctor' => 'Thêm bác sĩ',
        ],
        'work_schedule' => [
            'day' => 'Day',
            'start_time' => 'Start time',
            'end_time' => 'End time',
        ]
    ],

    'settings' => [
        'weekdays' => [
            'monday' => 'Thứ Hai',
            'tuesday' => 'Thứ Ba',
            'wednesday' => 'Thứ Tư',
            'thursday' => 'Thứ Năm',
            'friday' => 'Thứ Sáu',
            'saturday' => 'Thứ Bảy',
            'sunday' => 'Chủ Nhật',
        ],
        'genders' => [
            'male' => 'Nam',
            'female' => 'Nữ',
            'other' => 'Khác'
        ],
        'statuses' => [
            'scheduled' => 'Đã lên lịch',
            'confirmed' => 'Đã xác nhận',
            'checked_in' => 'Đã đến',
            'in_progress' => 'Đang khám',
            'completed' => 'Đã khám xong',
            'cancelled' => 'Đã huỷ',
            'not_informed' => 'Không đến, và không thông báo',
            'rescheduled' => 'Đã lên lịch lại',
        ],
        'priorities' => [
            'low' => 'Không khẩn cấp/Tái khám định kỳ',
            'medium' => 'Lịch khám bình thường',
            'high' => 'Ưu tiên cao, nên sắp xếp sớm'
        ],
        'labels' => [
            'appointment_information' => 'Thông tin cuộc hẹn',
            'patient_information' => 'Thông tin bệnh nhân',
            'doctor_information' => 'Thông tin bác sĩ',
        ],
        'schedule_navigation_group' => 'Lịch trình',
        'internal_navigation_group' => 'Nội bộ',
        'no_information' => 'Không có thông tin'
    ],

    'phones' => [
        'translation' => 'Điện thoại',
        'translation_plural' => 'Điện thoại',
        'fields' => [
            'phone_type' => 'Loại',
            'phone_number' => 'Số điện thoại',
            'is_main' => 'SĐT chính?',
        ],
        'types' => [
            'mobile' => 'Di động',
            'work' => 'Công việc',
            'fax' => 'Fax',
            'landline' => 'Điện thoại cố định',
        ],
        'actions' => [
            'add_new_phone' => 'Thêm SĐT mới'
        ],
    ],

    'addresses' => [
        'translation' => 'Địa chỉ',
        'translation_plural' => 'Địa chỉ',
        'fields' => [
            'address_type' => 'Loại',
            'address_line_1' => 'Thông tin địa chỉ',
            'address_line_2' => 'Thông tin địa chỉ 2',
            'city' => 'Thành phố',
            'region' => 'Khu vực/Tỉnh',
            'postal_code' => 'Mã bưu chính',
            'country' => 'Quốc gia',
        ],
        'types' => [
            'home' => 'Nhà riêng',
            'office' => 'Văn phòng'
        ],
        'actions' => [
            'add_new_address' => 'Thêm địa chỉ mới'
        ],
    ],

    'appointments' => [
        'translation' => 'Lịch khám',
        'translation_plural' => 'Lịch khám',
        'fields' => [
            'patient' => 'Bệnh nhân',
            'appointment_datetime' => 'Ngày khám',
            'checked_in_at' => 'Bệnh nhân đến lúc',
            'status' => 'Trạng thái',
            'priority' => 'Độ ưu tiên',
            'cancellation_reason' => 'Lý do huỷ',
            'comment' => 'Thông tin thêm',
            'request_for_examination' => 'Yêu cầu khám',
        ],
        'actions' => [
            'confirm' => 'Xác nhận',
            'check_in_appointment' => 'Đã đến',
            'cancel_appointment' => 'Huỷ hẹn',
            'patient_not_coming' => 'Bệnh nhân không đến',
            'schedule_appointment' => 'Lên lịch khám'
        ],
        'filters' => [
            'month' => 'Theo tháng',
            'date' => 'Theo ngày'
        ],
        'notifications' => [
            'appointment_is_cancelled' => 'Lịch hẹn đã được huỷ',
        ]
    ],

    'medical_conditions' => [
        'translation' => 'Bệnh',
        'translation_plural' => 'Bệnh',
        'fields' => [
            'code' => 'Mã',
            'name' => 'Tên',
            'description' => 'Mô tả',
        ],
        'actions' => [
            'add_new_medical_condition' => 'Thêm bệnh',
        ]
    ],

    'visits' => [
        'translation' => 'Yêu cầu khám',
        'translation_plural' => 'Yêu cầu khám',
        'fields' => [
            'visit_date' => 'Bắt đầu khám lúc',
            'symptoms' => 'Triệu chứng',
            'diagnosis' => 'Chẩn đoán',
            'treatment' => 'Điều trị',
            'notes' => 'Ghi chú',
            'comeback_date' => 'Ngày tái khám',
            'status' => 'Trạng thái',
            'appointment_datetime' => 'Ngày hẹn',
            'patient' => 'Bệnh nhân',
            'doctor' => 'Bác sĩ khám',
            'examination_type' => 'Loại khám',
        ],
        'actions' => [
            'add_visit' => 'Thêm yêu cầu khám'
        ]
    ],

    'charts' => [
        'appointments_per_month' => [
            'heading' => 'Lượt khám trong tháng này',
            'datasets' => [
                'number_of_completed_appointments' => 'Số lượt khám đã hoàn thành',
            ]
        ],
        'appointments_per_week' => [
            'heading' => 'Lượt khám trong tuần này',
            'datasets' => [
                'number_of_completed_appointments' => 'Số lượt khám đã hoàn thành',
            ]
        ]
    ],

    'stats_widgets' => [
        'stats_overview' => [
            'heading' => 'Tổng quan về số liệu thống kê',
            'stats' => [
                'sum_of_patients' => [
                    'label' => 'Tổng số bệnh nhân',
                    'description' => 'Tính đến hiện tại',
                ],
                'sum_of_doctors' => [
                    'label' => 'Tổng số bác sĩ',
                    'description' => 'Tính đến hiện tại',
                ],
                'sum_of_completed_appointments_today' => [
                    'label' => 'Lượt khám đã hoàn thành',
                    'description' => 'Trong ngày ',
                ],
                'sum_of_completed_appointments_this_week' => [
                    'label' => 'Lượt khám đã hoàn thành',
                    'description' => 'Từ ',
                ]
            ]
        ]
    ]
];
