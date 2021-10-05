<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(category::class,'cat_id');
    }

    public function post()
    {
        return $this->hasMany(post::class,"subcategory");
    }
    
}

