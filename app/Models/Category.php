<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id');
    } 

    public function newsByCategory(){
        return $this->hasMany(News::class, 'category_id');
    }
    public function newsBySubcategory(){
        return $this->hasMany(News::class, 'subcategory_id');
    }
}
