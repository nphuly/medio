<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Enums;

enum DoctorSpeciality: string
{
    case GENERAL_INTERNAL = 'general_internal';
    case GENERAL_SURGERY = 'general_surgery';
    case CARDIOLOGY = 'cardiology';
    case RESPIRATORY = 'respiratory';
    case GASTROENTEROLOGY = 'gastroenterology';
    case ENDOCRINOLOGY = 'endocrinology';
    case UROLOGY = 'urology';
    case NEUROLOGY = 'neurology';
    case ORTHOPEDICS = 'orthopedics';
    case ENT = 'ent';
    case OPHTHALMOLOGY = 'ophthalmology';
    case OBSTETRICS_GYNECOLOGY = 'obstetrics_gynecology';
    case PEDIATRICS = 'pediatrics';
    case DERMATOLOGY = 'dermatology';
    case ONCOLOGY = 'oncology';
    case HEMATOLOGY = 'hematology';
    case RADIOLOGY = 'radiology';
    case ANESTHESIOLOGY = 'anesthesiology';
    case TRADITIONAL_MEDICINE = 'traditional_medicine';
    case PSYCHIATRY = 'psychiatry';
    case REHABILITATION = 'rehabilitation';

    public function label(): string
    {
        return match ($this) {
            self::GENERAL_INTERNAL => __('specialities.doctor.general_internal'),
            self::GENERAL_SURGERY => __('specialities.doctor.general_surgery'),
            self::CARDIOLOGY => __('specialities.doctor.cardiology'),
            self::RESPIRATORY => __('specialities.doctor.respiratory'),
            self::GASTROENTEROLOGY => __('specialities.doctor.gastroenterology'),
            self::ENDOCRINOLOGY => __('specialities.doctor.endocrinology'),
            self::UROLOGY => __('specialities.doctor.urology'),
            self::NEUROLOGY => __('specialities.doctor.neurology'),
            self::ORTHOPEDICS => __('specialities.doctor.orthopedics'),
            self::ENT => __('specialities.doctor.ent'),
            self::OPHTHALMOLOGY => __('specialities.doctor.ophthalmology'),
            self::OBSTETRICS_GYNECOLOGY => __('specialities.doctor.obstetrics_gynecology'),
            self::PEDIATRICS => __('specialities.doctor.pediatrics'),
            self::DERMATOLOGY => __('specialities.doctor.dermatology'),
            self::ONCOLOGY => __('specialities.doctor.oncology'),
            self::HEMATOLOGY => __('specialities.doctor.hematology'),
            self::RADIOLOGY => __('specialities.doctor.radiology'),
            self::ANESTHESIOLOGY => __('specialities.doctor.anesthesiology'),
            self::TRADITIONAL_MEDICINE => __('specialities.doctor.traditional_medicine'),
            self::PSYCHIATRY => __('specialities.doctor.psychiatry'),
            self::REHABILITATION => __('specialities.doctor.rehabilitation'),
        };
    }

    public static function specialities(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($speciality) => [
            $speciality->value => $speciality->label()
        ])->toArray();
    }
}
