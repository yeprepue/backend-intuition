<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'question_name',
    ];

    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class, 'id_question');
    }
}
