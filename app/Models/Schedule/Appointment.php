<?php

namespace App\Models\Schedule;

use App\Models\Patients\Patient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    const string PATIENT_ID = 'patient_id';
    const string APPOINTMENT_DATETIME = 'appointment_datetime';
    const string CHECKED_IN_AT = 'checked_in_at';
    const string CANCELED_AT = 'canceled_at';
    const string STATUS = 'status';
    const string PRIORITY = 'priority';
    const string CANCELLATION_REASON = 'cancellation_reason';
    const string COMMENTS = 'comments';

    protected $fillable = [
        self::PATIENT_ID,
        self::APPOINTMENT_DATETIME,
        self::CHECKED_IN_AT,
        self::CANCELED_AT,
        self::STATUS,
        self::PRIORITY,
        self::CANCELLATION_REASON,
        self::COMMENTS,
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, self::PATIENT_ID);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }
}
