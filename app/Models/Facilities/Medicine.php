<?php

namespace App\Models\Facilities;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    const string NAME = 'name';
    const string GENERIC_NAME = 'generic_name';
    const string CODE = 'code';
    const string FORM = 'form';
    const string STRENGTH = 'strength';
    const string MANUFACTURER = 'manufacturer';
    const string DESCRIPTION = 'description';

    protected $fillable = [
        self::NAME,
        self::GENERIC_NAME,
        self::CODE,
        self::FORM,
        self::STRENGTH,
        self::MANUFACTURER,
        self::DESCRIPTION,
    ];
}
