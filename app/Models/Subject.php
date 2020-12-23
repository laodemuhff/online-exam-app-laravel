<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name'
    ];

    public function exam_subject(){
        return $this->hasMany(ExamSubject::class, 'id_subject', 'id');
    }

    public function question_subject(){
        return $this->hasMany(QuestionSubject::class, 'id_subject', 'id');
    }
}
