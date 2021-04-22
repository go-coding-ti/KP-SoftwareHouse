<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\BlogCategory;

class BlogCategoryController extends Controller
{
    /**
     * fungsi construct merupakan fungsi paling awal dijalankan dan berfungsi untuk menjalankan
     * middleware auth, agar admin saja yang dapat mengakses
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * fungsi index merupakan fungsi yang ditujukan untuk menampilkan view html untuk
     * menampilkan page awal untuk manajemen data news category
     */  
    public function index(){
        $blogcategories = BlogCategory::all();
        return view('admin.blog.category', compact('blogcategories'));
    }

    /**
     * fungsi store berfungsi untuk menyimpan data kedalam database sesuai dengan isi
     * dari variable request. Terdapat perintah validator untuk melakukan validasi
     * terhadap masukan yang diberikan oleh sistem agar sesuai dengan kebutuhan yang diperlukan.
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'name_en' => 'required|min:3'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
        
        $blogCategory = new BlogCategory;
        $blogCategory->name = $request->name;
        $blogCategory->name_en = $request->name_en;
        $blogCategory->save();

        return back()->with('statusInput', 'News Category successfully added to record');
    }

    /**
     * fungsi edit merupakan fungsi untuk memberikan hasil akhir berupa json, dikarenakan
     * fungsi ini akan dipanggil oleh ajax. Fungsi ini akan me-return nilai dari salah satu
     * news kategory.
     */
    public function edit($id){
        $blog_category = BlogCategory::find($id);
        return response()->json(['success' => 'Berhasil', 'blog_category' => $blog_category]);
    }

    /**
     * fungsi update sama hampir sama dengan fungsi store,hanya saja fungsi update perlu
     * parameter id sebagai kunci untuk mengubah data yang diinginkan.
     */
    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'name_en' => 'required|min:3',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $blog_category = BlogCategory::find($id);

        $blog_category->name = $request->name;
        $blog_category->name_en = $request->name_en;
        $blog_category->save();

        return back()->with('statusInput', 'news category successfully edited');
    }

    /**
     * fungsi destroy merupakan fungsi yang digunakan untuk menghapus data news
     * category yang berdasarkan parameter id yang diinginkan.
     */
    public function destroy($id){
        $blog_category = BlogCategory::find($id);
        $blog_category->delete();
        return back()->with('statusInput', 'news category successfully deleted');
    }

}
