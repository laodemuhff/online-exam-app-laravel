<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_exam
 * @property string $exam_session_code
 * @property string $exam_datetime
 * @property int $exam_duration
 * @property int $register_duration
 * @property string $use_base_questions
 * @property string $exam_session_status
 * @property string $created_at
 * @property string $updated_at
 * @property Exam $exam
 * @property ExamSessionInstructorEnroll[] $examSessionInstructorEnrolls
 * @property ExamSessionQuestion[] $examSessionQuestions
 * @property ExamSessionStudentEnroll[] $examSessionStudentEnrolls
 */
class ExamSession extends Model
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
    protected $fillable = ['id_exam', 'exam_session_code', 'exam_datetime', 'exam_duration', 'register_duration', 'use_base_questions', 'exam_session_status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo('App\Http\Models\Exam', 'id_exam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionInstructorEnrolls()
    {
        return $this->hasMany('App\Http\Models\ExamSessionInstructorEnroll', 'exam_session_code', 'exam_session_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionQuestions()
    {
        return $this->hasMany('App\Http\Models\ExamSessionQuestion', 'exam_session_code', 'exam_session_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionStudentEnrolls()
    {
        return $this->hasMany('App\Http\Models\ExamSessionStudentEnroll', 'exam_session_code', 'exam_session_code');
    }
}
