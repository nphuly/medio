<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    const string ADDRESS_TYPE = 'address_type';
    const string ADDRESS_LINE_1 = 'address_line_1';
    const string ADDRESS_LINE_2 = 'address_line_2';
    const string CITY = 'city';
    const string REGION = 'region';
    const string POSTAL_CODE = 'postal_code';
    const string COUNTRY = 'country';

    protected $fillable = [
        self::ADDRESS_TYPE,
        self::ADDRESS_LINE_1,
        self::ADDRESS_LINE_2,
        self::CITY,
        self::REGION,
        self::POSTAL_CODE,
        self::COUNTRY
    ];
}
