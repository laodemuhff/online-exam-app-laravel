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
        return $this->belongsTo(Subject::class, 'id_subject', 'id');
    }

    public function question(){
        return $this->belongsTo(Question::class, 'id_question', 'id');
    }
}
