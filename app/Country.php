<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'sortname','phonecode',
        ];
    protected $table = 'countries';
}
