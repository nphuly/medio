<?php

namespace App\Models\Patients;

use App\Models\Settings\Address;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientAddress extends Address
{
    const string PATIENT_ID = 'patient_id';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, self::PATIENT_ID);
    }
}
