<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminFeature extends Model
{
    protected $fillable = [
        'key',
        'module',
        'action'
    ];
}
