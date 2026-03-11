<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class favoriteBlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=User::all();
        $blogs=Blog::all();
        foreach($users as $user){
            $randomBlog=$blogs->random(rand(1,40))->pluck('id');
            $user->favoriteBlogs()->attach($randomBlog);
        }
    }
}
