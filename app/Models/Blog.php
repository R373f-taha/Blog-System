<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes,HasFactory;

    protected $fillable = ['title','content','image'];

    public  function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function favoriteByUsers(){

        return $this->belongsToMany(User::class,'favorite_blogs','blog_id','user_id');
    }
}
