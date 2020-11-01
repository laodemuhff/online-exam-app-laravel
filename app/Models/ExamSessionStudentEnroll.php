<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $exam_session_code
 * @property integer $id_user
 * @property string $student_session_code
 * @property string $created_at
 * @property string $updated_at
 * @property ExamSession $examSession
 */
class ExamSessionStudentEnroll extends Model
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
    protected $fillable = ['exam_session_code', 'id_user', 'student_session_code', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examSession()
    {
        return $this->belongsTo('App\Models\ExamSession', 'exam_session_code', 'exam_session_code');
    }
}
