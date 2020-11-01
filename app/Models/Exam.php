<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $exam_title
 * @property int $total_question
 * @property int $max_score
 * @property int $default_wrong_point
 * @property int $default_correct_point
 * @property string $exam_status
 * @property string $oecp_1
 * @property string $oecp_2
 * @property string $oecp_3
 * @property string $oecp_4
 * @property string $oecp_5
 * @property string $oecp_6
 * @property string $oecp_8
 * @property string $created_at
 * @property string $updated_at
 * @property ExamBaseQuestion[] $examBaseQuestions
 * @property ExamSession[] $examSessions
 */
class Exam extends Model
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
    protected $fillable = ['exam_title', 'total_question', 'max_score', 'default_wrong_point', 'default_correct_point', 'exam_status', 'oecp_1', 'oecp_2', 'oecp_3', 'oecp_4', 'oecp_5', 'oecp_6', 'oecp_8', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examBaseQuestions()
    {
        return $this->hasMany('App\Models\ExamBaseQuestion', 'id_exam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessions()
    {
        return $this->hasMany('App\Models\ExamSession', 'id_exam');
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
