<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'description', 'content','image', 'publish_at', 'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
}
    public function tags(){
        return $this->belongsToMany(tag::class);
    }

    public function deleteImage(){
        storage::delete($this->image);
    }
}
