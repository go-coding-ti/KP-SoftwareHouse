<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BlogImage;
use App\BlogCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $blogs = Blog::with('category')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function create(){
        $blogCategories = BlogCategory::all();
        return view('admin.blog.create', compact('blogCategories'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'content' => 'required|min:8',
            'image' => 'required|image',
            'id_blog_category' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $arrImage = [];

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->status = 1;
        $blog->id_blog_category = $request->id_blog_category;
        $image = $request->file('image');
        $imageLocation = "assets/image/blog/thumbnail";
        $imageName = $image->getClientOriginalName();
        $blog->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $blog->image);

        
        $detail = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/blog/artikel/'.$blog->title.'/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $blog->content = $detail;
        $blog->save();

        foreach($arrImage as $item){
            $blogImage = new BlogImage;
            $blogImage->id_blog = $blog->id_blog;
            $blogImage->image = $item;
            $blogImage->save();
        }

        return redirect(route('blog'));
    }

    public function show($id){
        $blog = Blog::find($id);
        return view('admin.blog.show', compact('blog'));
    }

    public function edit($id){
        $blog = Blog::with('category')->find($id);
        $blogCategories = BlogCategory::all();
        return view('admin.blog.edit', compact('blog', 'blogCategories'));
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'content' => 'required|min:8',
            'image' => 'image',
            'id_blog_category' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $blog = Blog::find($id);
        $arrImage = [];
        $idImage = [];

        if($request->image != null){
            $oldImage = $project->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/blog/thumbnail";
            $imageName = $image->getClientOriginalName();
            $blog->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $blog->image);
        }

        $blog->title = $request->title;
        $blog->id_blog_category = $request->id_blog_category;
        $blogImage = BlogImage::where('id_blog','=', $id)->get();
        
        $detail = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        //variabel dummy
            $arrsrc = [];
            $arrfoto = [];
            $status = '';
        //variabel dummy

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/blog/artikel/'.$blog->title.'/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }

            if($blogImage != null){
                foreach($blogImage as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage, $item->id_blog_image);
                    break;
                    }
                }   
            }
            
        }

        $blogImages = BlogImage::whereNotIn('id_blog_image', $idImage)->where('id_blog',$id)->get();
        BlogImage::whereNotIn('id_blog_image', $idImage)->where('id_blog',$id)->delete();
        foreach($blogImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail = $dom->savehtml();
        $blog->content = $detail;
        $blog->save();

        foreach($arrImage as $item){
            $blogImage = new BlogImage;
            $blogImage->id_blog = $blog->id_blog;
            $blogImage->image = $item;
            $blogImage->save();
        }
        
        return redirect(route('blog'));
    }

    public function status($id){
        $blog = Blog::find($id);
        if($blog->status == 1){
            $blog->status = 0;
        }else{
            $blog->status = 1;
        }

        $blog->save();
        return response()->json(['success' => 'berhasil terganti']);
    }

    public function destroy($id){
        $blog = Blog::find($id);
        $blog->delete();
        return back()->with(['statusInput' => 'Successfully delete news']);
    }
}
