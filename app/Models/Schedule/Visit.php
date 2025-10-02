<?php

namespace App\Models\Schedule;

use App\Models\Doctors\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    const string APPOINTMENT_ID = 'appointment_id';
    const string DOCTOR_ID = 'doctor_id';
    const string EXAMINATION_TYPE = 'examination_type';
    const string VISIT_DATE = 'visit_date';
    const string SYMPTOMS = 'symptoms';
    const string DIAGNOSIS = 'diagnosis';
    const string TREATMENT = 'treatment';
    const string NOTES = 'notes';
    const string COME_BACK_DATE = 'come_back_date';
    const string STATUS = 'status';

    protected $fillable = [
        self::APPOINTMENT_ID,
        self::DOCTOR_ID,
        self::EXAMINATION_TYPE,
        self::VISIT_DATE,
        self::SYMPTOMS,
        self::DIAGNOSIS,
        self::TREATMENT,
        self::NOTES,
        self::COME_BACK_DATE,
        self::STATUS,
    ];

    public function getTranslatedExaminationTypeAttribute(): string
    {
        return __('specialities.doctor.' . $this->getAttributeValue(self::EXAMINATION_TYPE));
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, self::APPOINTMENT_ID);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, self::DOCTOR_ID);
    }


}
