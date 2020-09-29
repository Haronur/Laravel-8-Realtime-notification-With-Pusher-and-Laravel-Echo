<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $table = 'posts';
    protected $fillable = ['title', 'body', 'userId'];  

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id')->whereNull('parent_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','userId', 'id');
    }
}
