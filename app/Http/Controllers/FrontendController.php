<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\Expertise;
use App\ProjectTrial;
use App\Blog;

class FrontendController extends Controller
{
    public function product(){
        $products = Product::all();
        return view('frontend.product',compact('products'));
    }

    public function project(){
        $projects = Project::all();
        $expertises = Expertise::all();
        return view('frontend.project', compact('projects','expertises'));
    }

    public function showExpertise($id){
        if($id == 0){
            $projects = Project::all();
        }else if($id < 100){
            $expertises = Expertise::with('project')->where('id_expertise',$id)->first();
            $projects = $expertises->project;
        }else{
            // $id = $id - 100;
            // $projects = App\ProjectTrial::with(['project' => function($q){
            //     $q->with(['expertise' => function($qq){
            //         $qq->where('tb_expertise.id_expertise',$id);
            //     }]);
            // }])->get();

            // $projects = App\Expertise::with(['project' => function($q){
            //     return $q->with('trial');
            // }])->where('id_expertise',$id)->get();
            // $projects = $projects
        }

        $result = view('frontend.showExpertise', compact('projects'))->render();

        return response()->json(['success' => 'berhasil', 'view' => $result]);
    }

    public function trial(){
        $trials = ProjectTrial::with('project.expertise')->get();
        $expertises = Expertise::all();
        return view('frontend.project_trial', compact('trials','expertises'));
    }

    public function blog(){
        $blogs = Blog::with('category')->where('status',1)->get();
        foreach($blogs as $blog){
            $blog->content = strip_tags($blog->content);
            $blog->content = substr($blog->content, 0, 200);
        }
        return view('frontend.blog', compact('blogs'));
    }

    public function blogShow($kategori,$judul){
        $category = $kategori;
        
        $blog = Blog::with('category')->where('title', $judul)->first();

        return view('frontend.blog_show', compact('blog'));
    }
}
