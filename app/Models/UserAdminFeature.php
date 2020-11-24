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
        return $this->belongsTo(AdminFeature::class, 'id_admin_feature', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
