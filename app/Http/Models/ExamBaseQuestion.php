<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_exam
 * @property integer $id_question
 * @property string $question_validity
 * @property string $created_at
 * @property string $updated_at
 * @property Exam $exam
 * @property Question $question
 */
class ExamBaseQuestion extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_exam', 'id_question', 'question_validity', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo('App\Http\Models\Exam', 'id_exam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Http\Models\Question', 'id_question');
    }
}
