<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Instansi;

class InstansiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $instansis = Instansi::all();
        return view('admin.instansi',compact('instansis'));
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_instansi' => 'required|min:3',
            'url' => 'required|min:5',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $instansi = new Instansi;
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->url = $request->url;
        $image = $request->file('image');
        $imageLocation = "assets/image/intansi";
        $imageName = $image->getClientOriginalName();
        $instansi->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $instansi->image);
        $instansi->save();

        return back()->with('statusInput', 'Instansi successfully added to record');
    }

    public function edit($id){
        $instansi = Instansi::find($id);
        return response()->json(['success' => 'Berhasil', 'instansi' => $instansi]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'nama_instansi' => 'required|min:3',
            'url' => 'required|min:5',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $instansi = Instansi::find($id);

        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->url = $request->url;
        if($request->image != null){
            $oldImage = $instansi->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/intansi";
            $imageName = $image->getClientOriginalName();
            $instansi->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $instansi->image);
        }
        $instansi->save();

        return back()->with('statusInput', 'Instansi successfully edited');
    }

    public function destroy($id){
        $instansi = Instansi::find($id);
        $instansi->delete();

        return back()->with('statusInput', 'Instansi successfully deleted');
    }
}
