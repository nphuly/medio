<?php

namespace App\Models\Patients;

use App\Models\Settings\MedicalCondition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientBackgroundCondition extends Model
{
    const string PATIENT_ID = 'patient_id';
    const string MEDICAL_CONDITION_ID = 'medical_condition_id';
    const string NOTES = 'notes';

    protected $fillable = [
        self::PATIENT_ID,
        self::MEDICAL_CONDITION_ID,
        self::NOTES,
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, self::PATIENT_ID);
    }

   public function medicalCondition(): BelongsTo
   {
       return $this->belongsTo(MedicalCondition::class, self::MEDICAL_CONDITION_ID);
   }
}
