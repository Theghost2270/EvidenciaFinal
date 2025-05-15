<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class WordEvent extends Model
{
    //
        use HasFactory;

    protected $fillable = [
        
    'user_id',
    'word_id',
    'user_name',
    'word_text',
    'event_id',
    'event',
    'event_time'
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
