<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $email_verified_at
 * @property string $password
 * @property string $level
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property ExamSessionInstructorEnroll[] $examSessionInstructorEnrolls
 */
class User extends Model
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
    protected $fillable = ['name', 'email', 'phone', 'email_verified_at', 'password', 'level', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examSessionInstructorEnrolls()
    {
        return $this->hasMany('App\Http\Models\ExamSessionInstructorEnroll', 'id_user');
    }
}
