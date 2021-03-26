<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\Expertise;
use App\ProjectTrial;
use App\Blog;
Use App\GlobalFunction;

class FrontendController extends Controller
{
    private $idx;
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
        }else if($id == 100){
            $trials = ProjectTrial::with('project')->get();
        }else{
            $id = $id - 100;
            $this->idx = $id;

            $trials = ProjectTrial::with('project')->whereHas('project',function($q){
                return $q->whereHas('expertise',function($qq){
                    return $qq->where('tb_detail_expertise.id_expertise',$this->idx);
                });
            })->get();

            $id = $id+100;
        }

        if($id < 99){
            $result = view('frontend.showExpertise', compact('projects'))->render();
        }else{
            $result = view('frontend.showExpertiseTrial', compact('trials'))->render();
        }

        return response()->json(['success' => 'berhasil', 'view' => $result]);
    }

    public function trial(){
        $this->idx = 2;
        $trials = ProjectTrial::with('project')->get();
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
        $judul = GlobalFunction::spaceChange(2,$judul);
        
        $blog = Blog::with('category')->where('title', $judul)->first();

        return view('frontend.blog_show', compact('blog'));
    }
}
