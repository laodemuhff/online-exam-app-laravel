<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSubject extends Model
{
    protected $fillable = [
        'id_subject',
        'id_exam'
    ];

    public function subject(){
        return $this->belongsTo('App/Models/Subject', 'id_subject', 'id');
    }

    public function exam(){
        return $this->belongsTo('App/Models/Exam', 'id_exam', 'id');
    }
}
