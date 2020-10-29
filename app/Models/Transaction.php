<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Transaction extends Model
{
    protected $fillable = [
        'nama_customer',
        'alamat_customer',
        'no_hp_customer',
        'id_armada',
        'durasi_sewa',
        'pickup_date',
        'note',
        'status_lepas_kunci',
        'status_pengambilan',
        'status_transaksi',
        'grand_total'
    ];

    public function armada(){
        return $this->belongsTo('App\Models\Armada', 'id_armada', 'id');
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
