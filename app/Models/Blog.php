<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','content','image'];

    public  function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function favoriteByUser(){

        return $this->belongsToMany(User::class,'favorite_blogs','user_id','blog_id');
    }
}
