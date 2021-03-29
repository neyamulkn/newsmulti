<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $guarded = [];
    protected $dates = ['publish_date'];
    public function reporter(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categoryList(){
        return $this->belongsTo(Category::class, 'category');
    }
    public function subcategoryList(){
        return $this->hasOne(SubCategory::class, 'id', 'subcategory'); //for hasOne first join tbl collum name then primary key collum name
    }
    public function getCategory(){
        return $this->belongsTo(Category::class, 'category');
    }
    public function image(){
        return $this->belongsTo(MediaGallery::class, 'thumb_image');
    }
    public function comment(){
        return $this->hasMany(Comment::class, 'news_id');
    }
    public function attachFiles(){
        return $this->hasMany(NewsAttachment::class, 'news_id');
    }
    public function video(){
        return $this->hasOne(MediaGallery::class, 'id', 'video');
    }
}
