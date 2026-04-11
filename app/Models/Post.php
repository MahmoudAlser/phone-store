<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id';

    protected $fillable = ['p_title', 'p_content', 'post_cat', 'post_user', 'img'];

    public function categorys(){
        return $this->belongsTo(\App\Models\Category::class, 'post_cat', 'cat_id');
    }
    public function users(){
        return $this->belongsTo(\App\Models\User::class, 'post_user', 'id');
    }
    public function comments(){
        return $this->hasMany(\App\Models\Comment::class, 'com_post', 'post_id');
    }
}
