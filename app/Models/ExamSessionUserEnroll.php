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
class ExamSessionUserEnroll extends Model
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
    protected $fillable = ['id_exam_session', 'id_user', 'user_type', 'user_session_code', 'is_registered', 'current_active_nav', 'final_score', 'final_score_status', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examSession()
    {
        return $this->belongsTo(ExamSession::class, 'id_exam_session', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function exam_session_answers(){
        return $this->hasMany(ExamSessionAnswer::class, 'user_session_code');
    }
}
