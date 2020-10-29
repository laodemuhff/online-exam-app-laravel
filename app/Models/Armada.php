<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Armada extends Model
{
    protected $fillable = [
        'kode_armada',
        'id_tipe_armada',
        'status_armada',
        'status_driver',
        'price',
        'photo'
    ];

    public function tipe_armada(){
        return $this->belongsTo('App\Models\TipeArmada', 'id_tipe_armada', 'id');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction', 'id_armada', 'id');
    }

    public static function getEnumValues($column){
        // Create an instance of the model to be able to get the table name
        $instance = new static;

        $arr = DB::select(DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$column.'"'));
        if (count($arr) == 0){
            return array();
        }
        // Pulls column string from DB
        $enumStr = $arr[0]->Type;

        // Parse string
        preg_match_all("/'([^']+)'/", $enumStr, $matches);

        // Return matches
        return isset($matches[1]) ? $matches[1] : [];
    }
}
