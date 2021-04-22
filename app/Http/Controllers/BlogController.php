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
    /*
        fungsi construct merupakan fungsi paling awal dijalankan dan berfungsi untuk menjalankan
        middleware auth, agar admin saja yang dapat mengakses
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*
        fungsi index merupakan fungsi yang ditujukan untuk menampilkan view html untuk
        menampilkan page awal untuk manajemen data news
    */
    public function index(){
        $blogs = Blog::with('category')->get();
        return view('admin.blog.index', compact('blogs'));
    }

    /*
        fungsi create berfungsi untuk menampilkan view html untuk page penambahan data
        news yang baru.
    */
    public function create(){
        $blogCategories = BlogCategory::all();
        return view('admin.blog.create', compact('blogCategories'));
    }

    /*
        fungsi store berfungsi untuk menyimpan data kedalam database sesuai dengan isi
        dari variable request. Terdapat perintah validator untuk melakukan validasi terhadap
        masukan yang diberikan oleh sistem agar sesuai dengan kebutuhan yang diperlukan.
    */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'content' => 'required|min:8',
            'title_en' => 'required|min:3',
            'content_en' => 'required|min:8',
            'image' => 'required|image',
            'id_blog_category' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $arrImage = [];
        $arrImage_en = [];

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->title_en = $request->title_en;
        $blog->status = 1;
        $blog->id_blog_category = $request->id_blog_category;

        /*
            perintah dibawah ini merupakan perintah yang berfungsi untuk memasukkan gambar
            yang dimasukkan pengguna kedalam server.
         */
        $image = $request->file('image');
        $imageLocation = "assets/image/blog/thumbnail";
        $imageName = $image->getClientOriginalName();
        $blog->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $blog->image);

        /*
            perintah dibawah berfungsi untuk melakukan penyimpanan gambar yang terdapat pada
            library summernote. Server perlu mengolah data request menjadi sebuah DOM agar
            dapat mencari direktori dari gambar dan menyimpannya pada server.
            Karena terdapat 2 bahasa sehingga perlu dilakukan dua kali, namun jika ada waktu
            tolong pembaca note ini bisa membuatkan fungsi agar lebih ringkas. Terimakasih.
         */
        $detail = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        /*
            proses foreach untuk mencari seluruh alamat direktori gambar dan langsung disimpan pada
            server menggunakan perintah Storage, sehingga perlu melakukan php:artisan storage:link
            agar dapat menggunakan file pada storage.

            Pencarian alamat direktori gambar menggunakan regex. 

            Setelah disiimpan pada server, disimpan juga dalam array yang kemudian akan disimpan 
            alamat assetnya pada database.
         */
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

        //content_en
        $detail_en = $request->content_en;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
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
                array_push($arrImage_en, $path);
            }
        }

        $detail_en = $dom->savehtml();
        $blog->content_en = $detail_en;
        $blog->save();

        /*
            Proses memasukkan asset gambar dalam array ke dalam database, agar mudah dikelola
            seperti penghapusan gambar dari server. Sama untuk kedua foreach. Jika ingin meringkas
            kode, pembaca kode ini jika berkenan bisa membuatkan fungsi baru agar lebih ringkas.
            Terimakasih.
         */
        foreach($arrImage as $item){
            $blogImage = new BlogImage;
            $blogImage->id_blog = $blog->id_blog;
            $blogImage->image = $item;
            $blogImage->type_content = 'id';
            $blogImage->save();
        }

        foreach($arrImage_en as $item){
            $blogImage = new BlogImage;
            $blogImage->id_blog = $blog->id_blog;
            $blogImage->image = $item;
            $blogImage->type_content = 'en';
            $blogImage->save();
        }

        return redirect(route('blog'));
    }
    
    /*
        fungsi show berfungsi untuk menampilkan view html untuk melihat salah satu news secara
        detail menggunakan parameter id yang diinginkan.
    */
    public function show($id){
        $blog = Blog::find($id);
        return view('admin.blog.show', compact('blog'));
    }

    /**
     * Fungsi edit berfungsi untuk menampilkan view html untuk proses pengeditan news sesuai
     * dengan parameter yang diinginkan
     */
    public function edit($id){
        $blog = Blog::with('category')->find($id);
        $blogCategories = BlogCategory::all();
        return view('admin.blog.edit', compact('blog', 'blogCategories'));
    }

    /**
     * Fungsi update serupa dengan fungsi store hanya saja terdapat parameter id untuk melakukan
     * perubahan data pada satu data sesuai id saja. Dan juga ada tambahan kode perintah ketika
     * terjadi perubahan gambar pada library summernote.
     */
    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'content' => 'required|min:8',
            'title_en' => 'required|min:3',
            'content_en' => 'required|min:8',
            'image' => 'image',
            'id_blog_category' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $blog = Blog::find($id);
        $arrImage = [];
        $arrImage_en = [];
        $idImage = [];
        $idImage_en = [];

        /**
         * Perintah untuk menghapus gambar yang lama ketika terjadi perubahan gambar thumbnail
         * setelah dihapus, gambar baru akan dikirimkan ke server dan alamat assetnya akan disimpan
         * ke dalam database.
         */
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
        $blog->title_en = $request->title_en;
        $blog->id_blog_category = $request->id_blog_category;

        /**
         * Memasukkan seluruh gambar pada konten blog dalam variabel yang nantinya akan dilakukan
         * proses pencocokan, apakah gambar tetap terpakai dalam konten atau dihapus nantinya.
         */
        $blogImage = BlogImage::where('id_blog','=', $id)->where('type_content','=','id')->get();
        
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

            /**
             * Proses pencocokan alamat direktori gambar pada request konten blog dengan yang ada
             * dalam database. Jika kedua hal tersebut sesuai maka gambar masih digunakan dan akan 
             * disimpan dalam database yang nantinya menjadi kunci untuk menghapus gambar yang sudah
             * tidak digunakan lagi dalam konten.
             * Begitu pula dengan konten english.
             */
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

        /**
         * Proses mencari gambar yang tidak terdapat dalam array dalam database dan data tersebut
         * yang merupakan asset dari gambar akan terhapus, dikarenakan sudah tidak digunakan lagi
         * dalam konten news tersebut.
         */
        $blogImages = BlogImage::whereNotIn('id_blog_image', $idImage)->where('id_blog',$id)->where('type_content','id')->get();
        BlogImage::whereNotIn('id_blog_image', $idImage)->where('id_blog',$id)->where('type_content','id')->delete();
        foreach($blogImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail = $dom->savehtml();
        $blog->content = $detail;

        //content_eng
        $blogImage_en = BlogImage::where('id_blog','=', $id)->where('type_content','=','en')->get();
        $detail_en = $request->content_en;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
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
                array_push($arrImage_en, $path);
            }

            if($blogImage_en != null){
                foreach($blogImage_en as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage_en, $item->id_blog_image);
                    break;
                    }
                }   
            }
            
        }

        

        $blogImages = BlogImage::whereNotIn('id_blog_image', $idImage_en)->where('id_blog',$id)->where('type_content','en')->get();
        BlogImage::whereNotIn('id_blog_image', $idImage_en)->where('id_blog',$id)->where('type_content','en')->delete();
        foreach($blogImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail_en = $dom->savehtml();
        $blog->content_en = $detail_en;

        $blog->save();

        foreach($arrImage as $item){
            $blogImage = new BlogImage;
            $blogImage->id_blog = $blog->id_blog;
            $blogImage->image = $item;
            $blogImage->type_content = 'id';
            $blogImage->save();
        }

        foreach($arrImage_en as $item){
            $blogImage = new BlogImage;
            $blogImage->id_blog = $blog->id_blog;
            $blogImage->image = $item;
            $blogImage->type_content = 'en';
            $blogImage->save();
        }
        
        return redirect(route('blog'));
    }

    /**
     * fungsi status berfungsi untuk mengubah status news menjadi aktif atau tidak aktif
     * status 1 berarti aktif dan 0 berarti tidak aktif.
     * Jika status sebelumnya aktif akan dirubah menjadi tidak aktif dan vice versa
     * Fungsi ini digunakan oleh AJAX dan hasil kembalinya berupa json.
     */
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

    /**
     * Fungsi destroy merupakan fungsi yang digunakan untuk menghapus data news sesuai dengan
     * parameter id yang diinginkan.
     */
    public function destroy($id){
        $blog = Blog::find($id);
        $blog->delete();
        return back()->with(['statusInput' => 'Successfully delete news']);
    }
}
