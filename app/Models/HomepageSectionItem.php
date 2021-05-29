<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageSectionItem extends Model
{
     use HasFactory;
  
    protected $guarded = [];
    public function news(){
        return $this->belongsTo(News::class, 'item_id', 'id');
    }

	public function newsByCategory(){
        return $this->hasMany(News::class, 'category','item_id')->where('lang',  'bd');
    }   
    public function englishNewsByCategory(){
        return $this->hasMany(News::class, 'category','item_id')->where('lang', '!=', 'bd');
    }

    public function getCategories(){
        return $this->hasMany(SubCategory::class, 'category_id', 'item_id');
    } 

    public function category(){
        return $this->belongsTo(Category::class, 'item_id', 'id');
    }
    public function getAds(){
        return $this->hasMany(Addvertisement::class, 'id', 'item_id');
    } 

    public function ads_details(){
        return $this->belongsTo(Addvertisement::class, 'item_id', 'id');
    }
    public function banner(){
        return $this->belongsTo(Banner::class, 'item_id', 'id');
    }
}
