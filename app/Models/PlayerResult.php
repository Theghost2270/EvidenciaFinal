<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerResult extends Model
{
    //
    protected $fillable = [
        'user_id', // Agrega el campo user_id aquí
        'correct_answers',
        'wrong_answers',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function word() { return $this->belongsTo(Word::class); }
    public function category() { return $this->belongsTo(Category::class); }

}
