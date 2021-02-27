<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Expertise;

class ExpertiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $expertises = Expertise::all();
        return view('admin.expertise', compact('expertises'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $expertise = new Expertise;
        $expertise->name = $request->name;
        $expertise->description = $request->description;
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imageLocation = 'assets/image/expertise';
        $expertise->image = $imageLocation.'/'.$imageName;
        $image->move($imageLocation, $imageName);
        $expertise->save();

        return back()->with('statusInput', 'Expertise successfully added');
    }

    public function edit($id){
        $expertise = Expertise::find($id);
        return response()->json(['success' => 'berhasil', 'expertise' => $expertise]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $expertise = Expertise::find($id);

        $expertise->name = $request->name;
        $expertise->description = $request->description;
        if($request->image){
            $oldImage = $expertise->image;
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageLocation = 'assets/image/expertise';
            File::delete($oldImage);
            $expertise->image = $imageLocation.'/'.$imageName;
            $image->move($imageLocation,$imageName);
        }
        $expertise->save();
        return back()->with('statusInput', 'Expertise successfully updated');
    }

    public function destroy($id){
        $expertise = Expertise::find($id);
        $expertise->delete();
        return back()->with('statusInput', 'Expertise successfully deleted');
    }
}
