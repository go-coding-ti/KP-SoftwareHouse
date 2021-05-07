<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Product;
use App\Page;
use App\Instansi;
use App\DetailInstansi;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $products = Product::with('page')->get();
        $pages = Page::all();
        $instansis = Instansi::all();
        return view('admin.product',compact('products','pages','instansis'));
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'description' => 'required|min:8',
            'description_en' => 'required|min:8',
            'image' => 'required|image',
            'type_page' => 'required',
            'instansi' => 'required'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->description_en = $request->description_en;
        $product->url = $request->url;
        $image = $request->file('image');
        $imageLocation = "assets/image/product";
        $imageName = $image->getClientOriginalName();
        $product->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $product->image);

        if($request->type_page == 1){
            $product->url = null;
            if($request->id_page){
                $product->id_page = $request->id_page;
            }else{
                return back()->withErrors('Internal Page Cannot be null');
            }
        }else{
            if($request->url){
                $product->url = $request->url;
            }else{
                return back()->withErrors('External URL Cannot be null');
            }
            $product->id_page = null;
        }

        if($request->has('status_home')){
            $product->status_home = 1;
        }else{
            $product->status_home = 1;
        }

        $product->save();

        foreach($request->instansi as $instansi){
            $detailInstansi = new DetailInstansi;
            $detailInstansi->id_product = $product->id_product;
            $detailInstansi->id_instansi = $instansi;
            $detailInstansi->save();
        }

        return back()->with('statusInput', 'Product successfully added to record');
    }

    public function edit($id){
        $product = Product::with('page')->find($id);
        $instansi = DetailInstansi::where('id_product',$product->id_product)->get();
        $arrinstansi = [];

        foreach($instansi as $item){
            array_push($arrinstansi,$item->id_instansi);
        }
        return response()->json(['success' => 'Berhasil', 'product' => $product,'instansi' => $arrinstansi]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'description' => 'required|min:8',
            'description_en' => 'required|min:8',
            'image' => 'image',
            'type_page' => 'required',
            'instansi' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $product = Product::find($id);
        $deletedInstansi = DetailInstansi::where('id_product',$product->id_product)->delete();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->description_en = $request->description_en;
        $product->url = $request->url;
        if($request->image != null){
            $oldImage = $product->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/product";
            $imageName = $image->getClientOriginalName();
            $product->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $product->image);
        }
        $product->save();

        foreach($request->instansi as $instansi){
            $detailInstansi = new DetailInstansi;
            $detailInstansi->id_product = $product->id_product;
            $detailInstansi->id_instansi = $instansi;
            $detailInstansi->save();
        }

        return back()->with('statusInput', 'Product successfully edited');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product'));

        return back()->with('statusInput', 'Product successfully deleted');
    }

    public function statusHome($id){
        $product = Product::find($id);
        if($product->status_home == 1){
            $product->status_home = 0;
            $product->save();
            $msg = 'Status Product now cant see at home page';
        }else{
            $product->status_home = 1;
            $product->save();
            $msg = 'Status Product now can see at home page';
        }
        

        return response()->json(['success' => $msg, 'product' => $product]);
    }
}
