<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Project;
use App\Expertise;
use App\ProjectTrial;
use App\Blog;
use App\BlogCategory;
Use App\GlobalFunction;
use App\Preference;
use App\SocialMedia;
use App\Menu;
use App\SubMenu;
use App\Page;
use App\Instansi;
use App\DetailInstansi;
use App\Team;
use App\AboutUs;

class FrontendController extends Controller
{
    private $idx,$kategori,$preference,$socialmedias,$submenu,$menu,$langugae;

    /**
     * Fungsi construct pada class ini berfungsi untuk menjalankan proses paling pertama
     * proses yang dijalankan adalah menyimpan ada preference dari webisite untuk digunakan pada
     * seluruh page, maka perlu dilakukan di construct agar tinggal dipakai di fungsi lain tidak
     * perlu inisialisasi. Kemudian ada data social media, menu, sub menu, bahasa, dan mendefinisikan
     * bahasa awal yang ditampilkan adalah bahasa Indonesia.
     */
    public function __construct()
    {
        $this->preference = Preference::all();
        $this->socialmedias = SocialMedia::all();
        $this->menu = Menu::with('submenu')->get();
        $this->submenu = SubMenu::all();
        $this->language = 'id';
        if(!session()->has('language')){
            session()->put('language', 'id');
        }
    }

    /**
     * Fungsi home bertujuan untuk menampilkan view html untuk page awal dari website untuk
     * dilihat oleh pengunjung.
     */
    public function home(){
        $expertises = Expertise::all();
        $products = Product::where('status_home',1)->get();
        $projects = Project::where('status_home',1)->get();
        $instansiInDetail = DetailInstansi::pluck('id_instansi');
        $instansis = Instansi::whereIn('id_instansi',$instansiInDetail)->get();
        return view('welcome', ['preference' => $this->preference,
        'expertises' => $expertises,
        'products' => $products,
        'projects' => $projects,
        'instansis' => $instansis,
        'socialmedias' => $this->socialmedias,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

    /**
     * Fungsi product bertujuan menampilkan page view html untuk page product
     */
    public function product(){
        $products = Product::all();
        return view('frontend.product',['preference' => $this->preference,
        'products' => $products,
        'socialmedias' => $this->socialmedias,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

    /**
     * Fungsi project bertujuan menampilkan page view html untuk page project
     */
    public function project(){
        $projects = Project::all();
        $expertises = Expertise::all();
        return view('frontend.project', ['preference' => $this->preference,
        'expertises' => $expertises,
        'socialmedias' => $this->socialmedias,
        'projects' => $projects,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

    /**
     * Fungsi showExpertise merupakan fungsi yang dijalankan oleh AJAX untuk menampilkan
     * project atau demo project sesuai dengan expertise yang tersedia.
     */
    public function showExpertise($id){
        if($id == 0){
            //show expertise pada page project dan menampilkan seluruh project
            $projects = Project::all();
        }else if($id < 100){
            //show expertise pada pgae project dan menampilkan project dari salah satu expertise
            $expertises = Expertise::with('project')->where('id_expertise',$id)->first();
            $projects = $expertises->project;
        }else if($id == 100){
            //show expertise pada page demo project dan menampilkan seluruh demo project
            $trials = ProjectTrial::with('project')->get();
        }else{
            //show expertise pada page dmeo project dan menampilan demo project dari salah satu expertise
            $id = $id - 100;
            $this->idx = $id;

            /**
             * Perintah untuk menampung data demo project yang berelasi dengan project dan memerlukan
             * kondisi yang terdapat pada project, sehingga terdapat sebuah fungsi berantai 
             * dari perintah whereHas.
             */
            $trials = ProjectTrial::with('project')->whereHas('project',function($q){
                return $q->whereHas('expertise',function($qq){
                    return $qq->where('tb_detail_expertise.id_expertise',$this->idx);
                });
            })->get();

            $id = $id+100;
        }

        //menampilkan view html sesuai parameter id, apakah project atau demoproject.
        if($id < 99){
            $result = view('frontend.showExpertise', compact('projects'))->render();
        }else{
            $result = view('frontend.showExpertiseTrial', compact('trials'))->render();
        }
        
        //hasil kembali berupa json karena fungsi ini digunakan oleh ajax.
        return response()->json(['success' => 'berhasil', 'view' => $result]);
    }

    /**
     * Fungsi trial bertujuan untuk menampilakan view html untuk page demo project
     */
    public function trial(){
        $this->idx = 2;
        $trials = ProjectTrial::with('project')->get();
        $expertises = Expertise::all();
        return view('frontend.project_trial', ['preference' => $this->preference,
        'expertises' => $expertises,
        'socialmedias' => $this->socialmedias,
        'trials' => $trials,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

     /**
     * Fungsi trial bertujuan untuk menampilakan view html untuk page news
     */
    public function blog(){
        $blogs = Blog::with('category')->where('status',1)->get();
        $blogCategories = BlogCategory::with('blog')->get();
        foreach($blogs as $blog){
            $blog->content = strip_tags($blog->content);
            $blog->content = substr($blog->content, 0, 200);
            $blog->content_en = strip_tags($blog->content);
            $blog->content_en = substr($blog->content, 0, 200);
        }
        return view('frontend.blog', ['preference' => $this->preference,
        'blogs' => $blogs,
        'socialmedias' => $this->socialmedias,
        'categories' => $blogCategories,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

     /**
     * Fungsi trial bertujuan untuk menampilakan view html untuk page detail dari news berdasarkan
     * kategori dan judul news.
     */
    public function blogShow($kategori,$judul){
        //Perintah untuk preprocessing url menjadi judul yang benar, yang sebelumnya telah diformat agar menjadi url yang rapi
        $judul = GlobalFunction::spaceChange(2,$judul);
        
        $blog = Blog::with('category')->where('title', $judul)->first();
        $blogCategories = BlogCategory::with('blog')->get();

        return view('frontend.blog_show', ['preference' => $this->preference,
        'blog' => $blog,
        'socialmedias' => $this->socialmedias,
        'categories' => $blogCategories,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

    /**
     * Fungsi blogKategori berfungsi untuk menampilkan news sesuai dengan kategori yang dipilih.
     * 
     */
    public function blogKategori($kategori){
        $kategori = GlobalFunction::spaceChange(2,$kategori);
        $this->kategori = $kategori;
        $blogCategories = BlogCategory::with('blog')->get();
        $blogs = Blog::with('category')->whereHas('category', function($q){
            return $q->where('name',$this->kategori);
        })->where('status',1)->get();
        foreach($blogs as $blog){
            $blog->content = strip_tags($blog->content);
            $blog->content = substr($blog->content, 0, 200);
        }
        return view('frontend.blog', ['preference' => $this->preference,
        'blogs' => $blogs,
        'socialmedias' => $this->socialmedias,
        'categories' => $blogCategories,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }

    /**
     * Fungsi menu bertujuan untuk menampilkan view html sub page menu tambahan.
     * 
     */
    public function menu($menu){
        $menu = GlobalFunction::spaceChange(2,$menu);
        $varMenu =  Menu::with('page')->where('name',$menu)->first();

        if($varMenu){
            return view('frontend.page', ['preference' => $this->preference,
            'varMenu' => $varMenu,
            'socialmedias' => $this->socialmedias,
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'language' => $this->language ]);
    
        }else{
            return abort(404);
        }
    }

    /**
     * Fungsi menu bertujuan untuk menampilkan view html page sub menu tambahan.
     * 
     */
    public function submenu($menu,$submenu){
        $menu = GlobalFunction::spaceChange(2,$menu);
        $submenu = GlobalFunction::spaceChange(2,$submenu);
        $varMenu =  SubMenu::with('menu','page')->where('name',$submenu)->first();

        if($varMenu->menu){
            return view('frontend.page', ['preference' => $this->preference,
            'varMenu' => $varMenu,
            'socialmedias' => $this->socialmedias,
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'language' => $this->language ]);
        }else{
            return abort(404);
        }  
    }

    /**
     * Fungsi menu bertujuan untuk mengganti konten sesuai perbantian bahasa.
     * 
     */
    public function chageLanguage(Request $request){
        //mengganti bahasa sesuai dengan session yang telah dibuat.
        if($request->session()->has('language')){
            if($request->session()->get('language') == 'id'){
                $request->session()->put('language', 'en');
            }else{
                $request->session()->put('language', 'id');
            }
        } else {
            $request->session()->put('language', 'en');
        }

        return back();
    }

    public function pageProduct($product){
        $product = GlobalFunction::spaceChange(2,$product);
        $varProduct =  Product::with('page')->where('title',$product)->first();

        if($varProduct){
            return view('frontend.page', ['preference' => $this->preference,
            'varMenu' => $varProduct,
            'socialmedias' => $this->socialmedias,
            'menu' => $this->menu,
            'submenu' => $this->submenu,
            'language' => $this->language ]);
    
        }else{
            return abort(404);
        }
    }

    public function aboutUs(){
        $instansiInDetail = DetailInstansi::pluck('id_instansi');
        $instansis = Instansi::whereIn('id_instansi',$instansiInDetail)->get();
        $teams = Team::all();
        $aboutUs = AboutUs::first();

        return view('frontend.aboutUs',['preference' => $this->preference,
        'socialmedias' => $this->socialmedias,
        'instansis' => $instansis,
        'aboutUs' => $aboutUs,
        'teams' => $teams,
        'menu' => $this->menu,
        'submenu' => $this->submenu,
        'language' => $this->language ]);
    }
}
