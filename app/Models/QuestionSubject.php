<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionSubject extends Model
{
    protected $fillable = [
        'id_subject',
        'id_question'
    ];

    public function subject(){
        return $this->belongsTo('App/Models/Subject', 'id_subject', 'id');
    }

    public function question(){
        return $this->belongsTo('App/Models/Question', 'id_question', 'id');
    }
}
