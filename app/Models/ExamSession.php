<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\ExamBaseQuestion;
use App\Models\ExamSessionQuestion;

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
        'started_on_going_at',
        'started_by',
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
        'registration_status',
        'created_at',
        'updated_at'];

    protected $appends = [
        'total_question',
        'question_type'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'id_exam');
    }

    public function examSessionBaseQuestions()
    {
        return $this->hasMany(ExamSessionBaseQuestion::class, 'id_exam_session');
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
    public function examSessionUserEnrolls()
    {
        return $this->hasMany(ExamSessionUserEnroll::class, 'id_exam_session', 'id');
    }

    public function getTotalQuestionAttribute(){
        if((bool) $this->use_base_questions){
            return ExamBaseQuestion::where('id_exam', $this->id_exam)->get()->count();
        }else{
            return ExamSessionQuestion::where('id_exam', $this->id_exam)->get()->count();
        }
    }

    public function getQuestionTypeAttribute(){
        if((bool) $this->use_base_questions){
            $multiple_choice = new ExamBaseQuestion;
            $essay = new ExamBaseQuestion;
        }else{
            $multiple_choice = new ExamSessionQuestion;
            $essay = new ExamSessionQuestion;
        }

        $multiple_choice = $multiple_choice::with(['question' => function($query){$query->where('type', 'multiple_choice');}])->where('id_exam', $this->id_exam)->get()->toArray();
        $multiple_choice = sizeof(array_filter($multiple_choice,function($item){return $item['question'] != null;}));

        $essay = $essay::with(['question' => function($query){$query->where('type', 'essay');}])->where('id_exam', $this->id_exam)->get()->toArray();
        $essay =  sizeof(array_filter($essay,function($item){return $item['question'] != null;}));

        if($multiple_choice > 0 && $essay > 0)
            $type = 'multiple choice & essay';
        else if($multiple_choice == 0 && $essay > 0)
            $type = 'essay';
        else if($multiple_choice > 0 && $essay == 0)
            $type = 'multiple choice';
        else
            $type = 'unrecognizable';

        return $type;
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
