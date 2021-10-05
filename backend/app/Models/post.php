<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cat()
    {
        return $this->belongsTo(category::class,'category');
    }
    public function subcat()
    {
        return $this->belongsTo(subcategory::class,'subcategory');
    }
    public function comment()
    {
        return $this->hasMany(comment::class,"post_id")->orderBy('created_at','DESC');
    }
}
