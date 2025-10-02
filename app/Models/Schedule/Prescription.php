<?php

namespace App\Models\Schedule;

use App\Models\Doctors\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    const string VISIT_ID = 'visit_id';
    const string DOCTOR_ID = 'doctor_id';
    const string NOTES  = 'notes';

    protected $fillable = [
        self::VISIT_ID,
        self::DOCTOR_ID,
        self::NOTES,
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, self::DOCTOR_ID);
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, self::VISIT_ID);
    }
}
