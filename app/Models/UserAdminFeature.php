<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdminFeature extends Model
{
    protected $fillable = [
        'id_user',
        'id_admin_feature'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminFeature()
    {
        return $this->belongsTo('App\Models\AdminFeature', 'id_admin_feature', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
}
