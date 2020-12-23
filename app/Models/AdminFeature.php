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

    public function userAdminFeature()
    {
        return $this->hasMany(UserAdminFeature::class, 'id_admin_feature', 'id');
    }
}
