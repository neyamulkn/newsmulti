<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Notification extends Model
{
    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class, 'fromUser');
    }
    public function news(){
    	return $this->belongsTo(News::class, 'item_id');
    }
    public function comment(){
    	return $this->belongsTo(Comment::class, 'item_id');
    }
}
