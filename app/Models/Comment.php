<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Comment extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }    

    public function news(){
        return $this->belongsTo(News::class);
    }

    public function comment_reply(){
    	return $this->hasMany(Comment::class, 'comment_id','id');
    }
}
