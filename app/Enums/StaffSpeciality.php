<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum StaffSpeciality: string
{
    case GENERAL_NURSING = 'general_nursing';
    case LABORATORY_TECHNICIAN = 'laboratory_technician';
    case DIAGNOSTIC_IMAGE_TECHNICIAN = 'diagnostic_image_technician';
    case REHABILITATION_TECHNICIAN = 'rehabilitation_technician';
    case CLINICAL_PHARMACIST = 'clinical_pharmacist';
    case MEDICAL_ASSISTANT = 'medical_assistant';
    case MEDICAL_CUSTOMER_SERVICE_REPRESENTATIVE = 'medical_customer_service_representative';
    case MEDICAL_ADMINISTRATION = 'medical_administration';

    public function label(): string
    {
        return match ($this) {
            self::GENERAL_NURSING => __('specialities.staff.general_nursing'),
            self::LABORATORY_TECHNICIAN => __('specialities.staff.laboratory_technician'),
            self::DIAGNOSTIC_IMAGE_TECHNICIAN => __('specialities.staff.diagnostic_image_technician'),
            self::REHABILITATION_TECHNICIAN => __('specialities.staff.rehabilitation_technician'),
            self::CLINICAL_PHARMACIST => __('specialities.staff.clinical_pharmacist'),
            self::MEDICAL_ASSISTANT => __('specialities.staff.medical_assistant'),
            self::MEDICAL_CUSTOMER_SERVICE_REPRESENTATIVE => __('specialities.staff.medical_customer_service_representative'),
            self::MEDICAL_ADMINISTRATION => __('specialities.staff.medical_administration'),
        };
    }

    public static function specialities(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($speciality) => [
            $speciality->value => $speciality->label()
        ])->toArray();
    }
}
