<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\BlogCategory;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $blogcategories = BlogCategory::all();
        return view('admin.blog.category', compact('blogcategories'));
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        $blogCategory = new BlogCategory;
        $blogCategory->name = $request->name;
        $blogCategory->save();

        return back()->with('statusInput', 'News Category successfully added to record');
    }

    public function edit($id){
        $blog_category = BlogCategory::find($id);
        return response()->json(['success' => 'Berhasil', 'blog_category' => $blog_category]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $blog_category = BlogCategory::find($id);

        $blog_category->name = $request->name;
        $blog_category->save();

        return back()->with('statusInput', 'news category successfully edited');
    }

    public function destroy($id){
        $blog_category = BlogCategory::find($id);
        $blog_category->delete();
        return back()->with('statusInput', 'news category successfully deleted');
    }

}
