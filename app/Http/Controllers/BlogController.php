<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\BlogStore;
use App\Http\Requests\Blog\BlogUpdate;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs=Blog::all();
        return view('Blog.index',compact('blogs'))->with('success','Blogs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories=Category::all();

       return view('Blog.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStore $request)
    {
        $imagePath=null;

        $data=$request->validated();

        if($request->hasFile('image')){

         $imagePath=$request->file('image')->store('photos','public');

         }

        $data['image']=$imagePath;

        $blog=Blog::create($data);

        $blog->categories()->attach($request->categories);

        return redirect()->route('blogs.showAll')->with('success','تمت إضافة المدونة');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
          return view('Blog.show',compact('blog'))->with('success','المدونة');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
       $categories=Category::all();

       return view('Blog.update',compact('blog','categories'))->with('success','تعديل مدونة');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdate $request, Blog $blog)
    {
        $imagePath=null;
        $data=$request->validated();
        if($request->hasFile('image')){

            $imagePath=$request->file('image')->store('photos','public');
            $data['image']=$imagePath;
        }

        $blog->update($data);

        if($request->has('categories')){

        $blog->categories()->sync($request->categories);

        }

        return redirect()->route('blogs.showAll')->with('success','تمت تعديل المدونة');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function softDelete(Blog $blog)
    {
       $blog->delete();//soft delete
       return redirect()->route('blogs.showAll')->with('success','تمت أرشفة المدونة');
    }

    public function trash(){
        $blogs=Blog::onlyTrashed()->get();
        return view('Blog.recycleBin',compact('blogs'))->with('success','المدونات المؤرشفة');

    }
    public function forceDelete($blog_id){
        $blog=Blog::withTrashed()->findOrFail($blog_id);
        $blog->forceDelete();
        return redirect()->route('blogs.showAll')->with('success','تمت حذف المدونة');
    }

    public function restore($blog_id){
        $blog=Blog::onlyTrashed()->findOrFail($blog_id);
        $blog->restore();
          return redirect()->route('blogs.showAll')->with('success','تمت استعادة المدونة');


    }
    public function categories($blog_id){
    $blog=Blog::findOrFail($blog_id);
    $categories=Blog::with('categories')->get();
    return view('Blog.index',compact('categories'));

    }

    public function addToFav($blog_id){

        $blog=Blog::findOrFail($blog_id);


        if(Auth()->user()->favoriteBlogs()->where('blog_id',$blog_id))

            return redirect()->back()->with('error', 'المدونة موجودة بالفعل في المفضلة');

         Auth()->user()->favoriteBlogs->syncWithoutDetatching($blog_id);

        return redirect()->route('blogs.showAll')->with('success',' تمت إضافة المدونةإلى المفضلة');

    }
     public function removeFromFav($blog_id){

      if(!Auth()->user()->favoriteBlogs()->where('blog_id',$blog_id))

            return redirect()->back()->with('error', 'المدونة ليست موجودة  في المفضلة');

       Auth()->user()->favoriteBlogs()->
        return redirect()->route('blogs.showAll')->with('success',' تمت إضافة الإزالة من المفضلة');

    }

     public function favoritesBlog($user_id){

        $user=User::findOrFail($user_id);

        $user->favoriteBlogs()->get();

        return redirect()->route('blogs.showAll')->with('success',' تمت إضافة الإزالة من المفضلة');

    }
}
