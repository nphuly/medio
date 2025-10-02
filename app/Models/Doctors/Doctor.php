<?php

namespace App\Models\Doctors;

use App\Models\Schedule\Appointment;
use App\Models\Schedule\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    const string FIRST_NAME = 'first_name';
    const string MIDDLE_NAME = 'middle_name';
    const string LAST_NAME = 'last_name';
    const string DOB = 'dob';
    const string GENDER = 'gender';
    const string EMAIL = 'email';
    const string SPECIALITY = 'speciality';

    protected $fillable = [
        self::FIRST_NAME,
        self::MIDDLE_NAME,
        self::LAST_NAME,
        self::DOB,
        self::GENDER,
        self::EMAIL,
        self::SPECIALITY,
    ];

    public function getFullNameAttribute(): string
    {
        if (app()->getLocale() == 'vi') {
            return
                trim(
                    $this->getAttributeValue(self::LAST_NAME) . ' ' .
                    $this->getAttributeValue(self::MIDDLE_NAME) . ' ' .
                    $this->getAttributeValue(self::FIRST_NAME)
                );
        }

        return
            trim(
                $this->getAttributeValue(self::FIRST_NAME) . ' ' .
                $this->getAttributeValue(self::MIDDLE_NAME) . ', ' .
                $this->getAttributeValue(self::LAST_NAME)
            );
    }

    public function getWorkScheduleArrayAttribute(): array
    {
        return $this->workSchedule->map(function ($schedule) {
            return __('medio.settings.weekdays.' . $schedule->day) . ': ' . $schedule->start_time . ' - ' . $schedule->end_time;
        })->toArray();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(DoctorAddress::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(DoctorPhone::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    public function workSchedule(): HasMany
    {
        return $this->hasMany(DoctorWorkSchedule::class);
    }

}
