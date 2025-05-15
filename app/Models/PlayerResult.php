<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlayerResult extends Model
{
    //
    protected $fillable = [
        'user_id', 'word_id', 'category_id', 'is_correct'
    ];
    
    public function user() { 
        return $this->belongsTo(User::class); 
    }
    public function word() { 
        return $this->belongsTo(Word::class); 
    }
    public function category() { 
        return $this->belongsTo(Category::class); 
    }

}
