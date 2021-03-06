<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request){
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|min:3'
        // ]);

        // if($validator->fails()){
        //     return back()->withInput()->withErrors($validator);
        // }
        
        $blogCategory = new BlogCategory;
        $blogCategory->name = $request->name;
        $blogCategory->save();

        $blogCategories = BlogCategory::all();

        $view = view('admin.blog.blogCategory', compact('blogCategories'))->render();

        return response()->json(['success' => 'berhasil', 'view' => $view]);
    }

}
