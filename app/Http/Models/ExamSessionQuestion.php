<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $exam_session_code
 * @property integer $id_question
 * @property string $question_validity
 * @property string $created_at
 * @property string $updated_at
 * @property ExamSession $examSession
 * @property Question $question
 */
class ExamSessionQuestion extends Model
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
    protected $fillable = ['exam_session_code', 'id_question', 'question_validity', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examSession()
    {
        return $this->belongsTo('App\Http\Models\ExamSession', 'exam_session_code', 'exam_session_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Http\Models\Question', 'id_question');
    }
}
