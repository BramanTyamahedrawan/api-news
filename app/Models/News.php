<?php

namespace App\Models;

use App\Models\User;
use App\Models\NewsCategory;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = ['title', 'content', 'image', 'user_id', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->hasMany(NewsCategory::class);
    }
}
