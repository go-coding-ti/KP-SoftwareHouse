<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\ProjectTrial;
use App\Blog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $projects = Project::all();
        $projectTrials = ProjectTrial::all();
        $news = Blog::all();
        return view('home', compact('products', 'projects', 'projectTrials', 'news'));
    }
}
