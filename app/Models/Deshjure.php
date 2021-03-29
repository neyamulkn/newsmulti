<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deshjure extends Model
{
    protected $guarded = [];


    public function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'parent_id');
    }

    public function deshjureType()
    {
       return $this->belongsTo(Deshjure::class, 'parent_id');
    }

}
