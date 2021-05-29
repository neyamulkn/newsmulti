<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reporter extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function news(){
        return $this->hasMany(News::class, 'user_id');
    }

}
