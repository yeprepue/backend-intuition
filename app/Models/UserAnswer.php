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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'id_question');
    }
}
