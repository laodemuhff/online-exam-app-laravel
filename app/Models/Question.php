<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $question_description
 * @property string $type
 * @property int $correct_point
 * @property int $wrong_point
 * @property string $created_at
 * @property string $updated_at
 * @property ExamBaseQuestion[] $examBaseQuestions
 * @property ExamSessionQuestion[] $examSessionQuestions
 * @property Option[] $options
 */
class Question extends Model
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
    protected $fillable = ['question_description', 'type', 'use_default_correct_point', 'use_default_wrong_point', 'correct_point', 'wrong_point', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examBaseQuestions()
    {
        return $this->hasMany(ExamBaseQuestion::class, 'id_question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionQuestions()
    {
        return $this->hasMany(ExamSessionQuestion::class, 'id_question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(Option::class, 'id_question');
    }

    public function question_subject()
    {
        return $this->hasMany(QuestionSubject::class, 'id_question', 'id');
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
