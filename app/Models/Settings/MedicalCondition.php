<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class MedicalCondition extends Model
{
    const string CODE = 'code';
    const string NAME = 'name';
    const string DESCRIPTION = 'description';

    protected $fillable = [
        self::CODE,
        self::NAME,
        self::DESCRIPTION,
    ];


}
