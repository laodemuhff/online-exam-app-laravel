<?php

namespace App\Http\Models;

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
    protected $fillable = ['exam_session_code', 'id_user', 'id_question', 'multiple_choice_answer', 'essay_answer', 'created_at', 'updated_at'];

}
