<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'com_id';
    protected $fillable = ['com_content', 'com_user', 'com_post'];

    public function post(){
        return $this->belongsTo(Post::class, 'com_post', 'post_id');
    }
    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'com_user', 'id');
    }
}
