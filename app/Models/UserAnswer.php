<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'id_question',
        'answer',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_answers', 'id', 'id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'user_answers', 'id', 'id');
    }
}
