<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $exam_session_code
 * @property integer $id_user
 * @property integer $id_question
 * @property integer $multiple_choice_answer
 * @property string $essay_answer
 * @property string $created_at
 * @property string $updated_at
 */
class ExamSessionAnswer extends Model
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
    protected $fillable = [
        'exam_session_code',
        'id_user',
        'user_session_code',
        'id_exam_session_question',
        'multiple_choice_answer',
        'essay_answer',
        'created_at',
        'updated_at',
        'given_point'
    ];

    protected $appends = [
        'final_score',
        'right_answer',
        'wrong_answer'
    ];

    public function exam_session_user_enroll(){
        return $this->belongsTo(ExamSessionUserEnroll::class, 'user_session_code');
    }

    public function question(){
        return $this->belongsTo(ExamSessionQuestion::class, 'id_exam_session_question', 'id');
    }

    public function option(){
        return $this->belongsTo(ExamSessionOption::class, 'multiple_choice_answer', 'id');
    }

    public function getFinalScoreAttribute(){
        return Self::where('user_session_code', $this->user_session_code)->sum('given_point');
    }

    public function getRightAnswerAttribute(){
        return Self::whereHas('option', function($q){$q->where('answer_status', '1');})->where('user_session_code', $this->user_session_code)->count();
    }

    public function getWrongAnswerAttribute(){
        return Self::whereHas('option', function($q){$q->where('answer_status', '0');})->where('user_session_code', $this->user_session_code)->count();
    }

}
