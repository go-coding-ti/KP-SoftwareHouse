<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\Expertise;

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
        }else{
            $expertises = Expertise::with('project')->where('id_expertise',$id)->first();
            $projects = $expertises->project;
        }

        $result = view('frontend.showExpertise', compact('projects'))->render();

        return response()->json(['success' => 'Produk berhasil dimasukkan dalam cart', 'view' => $result]);
    }
}
