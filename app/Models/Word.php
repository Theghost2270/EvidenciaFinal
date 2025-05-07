<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['word', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }
}
