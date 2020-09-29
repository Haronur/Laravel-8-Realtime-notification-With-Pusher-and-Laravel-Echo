<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';
    protected $fillable = ['user_id', 'post_id', 'parent_id', 'body'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }
    
    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'parent_id');
    } 
    
    public function replie()
    {
        return $this->belongsTo('App\Models\Comment', 'parent_id');
    } 
}
