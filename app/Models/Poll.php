<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    public function pollOptions(){
        return $this->hasMany(PollQuestionAns::class, 'poll_id');
    }

    protected $dates = ['start_date'];
}
