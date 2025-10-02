<?php

namespace App\Models\Schedule;

use App\Models\Facilities\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionItem extends Model
{
    const string PRESCRIPTION_ID = 'prescription_id';
    const string MEDICINE_ID = 'medicine_id';
    const string DOSAGE = 'dosage';
    const string DURATION = 'duration';
    const string INSTRUCTIONS = 'instructions';

    protected $fillable = [
        self::PRESCRIPTION_ID,
        self::MEDICINE_ID,
        self::DOSAGE,
        self::DURATION,
        self::INSTRUCTIONS
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, self::PRESCRIPTION_ID);
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, self::MEDICINE_ID);
    }
}
