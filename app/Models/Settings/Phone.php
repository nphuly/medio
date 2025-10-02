<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    const string PHONE_TYPE = 'phone_type';
    const string PHONE_NUMBER = 'phone_number';
    const string IS_MAIN = 'is_main';

    protected $fillable = [
        self::PHONE_TYPE,
        self::PHONE_NUMBER,
        self::IS_MAIN
    ];
}
