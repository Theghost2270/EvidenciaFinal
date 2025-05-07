<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $fillable = ['option_text', 'is_correct', 'definition_id'];

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }
}
