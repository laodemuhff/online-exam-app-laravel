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
        return $this->hasMany('App\Models\UserAdminFeature', 'id_admin_feature', 'id');
    }
}
