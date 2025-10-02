<?php

namespace App\Models\Patients;

use App\Models\Settings\Phone;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientPhone extends Phone
{
    const string PATIENT_ID = 'patient_id';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, self::PATIENT_ID);
    }
}
