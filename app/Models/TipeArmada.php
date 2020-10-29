<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeArmada extends Model
{
    protected $fillable = [
        'tipe'
    ];

    public function armada(){
        return $this->hasMany('App\Models\Armada', 'id_tipe_armada', 'id');
    }
}
