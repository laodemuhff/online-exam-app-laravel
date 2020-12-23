<?php

namespace App\Models;

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
    protected $fillable = [
        'id_exam',
        'exam_session_code',
        'exam_datetime',
        'exam_duration',
        'register_duration',
        'use_base_questions',
        'allow_scrambled_questions',
        'allow_scrambled_options',
        'disallow_multiple_login',
        'disallow_navigation',
        'check_on_exam_similarity',
        'exam_similarity_value',
        'exam_session_status',
        'created_at',
        'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id_exam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionInstructorEnrolls()
    {
        return $this->hasMany(ExamSessionInstructorEnroll::class, 'exam_session_code', 'exam_session_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionQuestions()
    {
        return $this->hasMany(ExamSessionQuestion::class, 'exam_session_code', 'exam_session_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionStudentEnrolls()
    {
        return $this->hasMany(ExamSessionStudentEnroll::class, 'exam_session_code', 'exam_session_code');
    }

    public static function getPossibleEnumValues ($column) {
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
