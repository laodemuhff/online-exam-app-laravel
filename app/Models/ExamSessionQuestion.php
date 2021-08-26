<?php

namespace App\Models;

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
    protected $fillable = [
        'question_description',
        'type',
        'use_default_correct_point',
        'use_default_wrong_point',
        'correct_point',
        'wrong_point'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionBaseQuestions()
    {
        return $this->hasMany(ExamSessionBaseQuestion::class, 'id_exam_session_question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(ExamSessionOption::class, 'id_exam_session_question');
    }

    public function answers()
    {
        return $this->hasMany(ExamSessionAnswer::class, 'id_exam_session_question');
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
