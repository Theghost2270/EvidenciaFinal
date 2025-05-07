<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    protected $fillable = ['definition', 'word_id'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}
