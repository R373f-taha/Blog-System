<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStore;
use App\Http\Requests\Category\CategoryUpdate;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('Categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Categories.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStore $request)
    {
     Category::create($request->validated());
      return redirect()->route('categories.showAll')->with('success','تمت إضافة الفئة');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('Categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         return view('Categories.update',compact('category'))->with('success','تعديل الفئة');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdate $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('categories.showAll')->with('success','تمت تعديل الفئة');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.showAll')->with('success','تمت حذف الفئة');
    }
}
