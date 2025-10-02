<?php

namespace App\Models\Patients;

use App\Models\Schedule\Appointment;
use App\Models\Settings\Phone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    const string FIRST_NAME = 'first_name';
    const string MIDDLE_NAME = 'middle_name';
    const string LAST_NAME = 'last_name';
    const string DOB = 'dob';
    const string GENDER = 'gender';
    const string EMAIL = 'email';

    protected $fillable = [
        self::FIRST_NAME,
        self::MIDDLE_NAME,
        self::LAST_NAME,
        self::DOB,
        self::GENDER,
        self::EMAIL
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(PatientAddress::class);
    }

    public function mainPhone(): HasOne
    {
        return $this->hasOne(PatientPhone::class)->where(Phone::IS_MAIN, '=', true);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(PatientPhone::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function backgroundConditions(): HasMany
    {
        return $this->hasMany(PatientBackgroundCondition::class)
            ->when($this->exists, fn($q) => $q);
    }

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
}
