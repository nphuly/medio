<?php

namespace App\Models\Doctors;

use App\Models\Settings\Address;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorAddress extends Address
{
    const string DOCTOR_ID = 'doctor_id';

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, self::DOCTOR_ID);
    }
}
