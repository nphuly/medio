<?php

/**
 * @author  lpn
 * @ticket
 */

namespace App\Models\Doctors;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorWorkSchedule extends Model
{
    const string DOCTOR_ID = 'doctor_id';
    const string DAY = 'day';
    const string START_TIME = 'start_time';
    const string END_TIME = 'end_time';

    protected $table = 'doctor_work_schedule';

    public $timestamps = false;

    protected $fillable = [
        self::DOCTOR_ID,
        self::DAY,
        self::START_TIME,
        self::END_TIME,
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, self::DOCTOR_ID);
    }
}
