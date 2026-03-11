<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs=Blog::all();
        $categories=Category::all();
        foreach($blogs as $blog){
          $randomCategory=$categories->random(rand(1,20))->pluck('id');
          $blog->categories()->attach($randomCategory);
        }
    }
}
