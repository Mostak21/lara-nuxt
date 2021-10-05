<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->hasMany(subcategory::class,"cat_id");
    }

    public function post()
    {
        return $this->hasMany(post::class,"category");
    }
    
    
}
