<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class read_later extends Model
{
    protected $guarded = [];

    public function news(){
        return $this->belongsTo(News::class);
    }
}
