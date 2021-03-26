<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $products = Product::all();
        return view('admin.product',compact('products'));
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'url' => 'required|min:5',
            'description' => 'required|min:8',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->url = $request->url;
        $image = $request->file('image');
        $imageLocation = "assets/image/product";
        $imageName = $image->getClientOriginalName();
        $product->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $product->image);
        $product->save();

        return back()->with('statusInput', 'Product successfully added to record');
    }

    public function edit($id){
        $product = Product::find($id);
        return response()->json(['success' => 'Berhasil', 'product' => $product]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'url' => 'required|min:5',
            'description' => 'required|min:8',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
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

        return back()->with('statusInput', 'Product successfully edited');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect(route('product'));

        return back()->with('statusInput', 'Product successfully deleted');
    }
}
