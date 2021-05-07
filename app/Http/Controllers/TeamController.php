<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Team;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $teams = Team::all();
        return view('admin.team',compact('teams'));
    }

    public function insert(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'department' => 'required|min:3',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $team = new Team;
        $team->name = $request->name;
        $team->department = $request->department;
        $image = $request->file('image');
        $imageLocation = "assets/image/team";
        $imageName = uniqid().$image->getClientOriginalName();
        $team->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $team->image);
        $team->save();

        return back()->with('statusInput', 'Team successfully added to record');
    }

    public function edit($id){
        $team = Team::find($id);
        return response()->json(['success' => 'Berhasil', 'team' => $team, 'id' => $id]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'department' => 'required|min:3',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $team = Team::find($id);

        $team->name = $request->name;
        $team->department = $request->department;
        if($request->image != null){
            $oldImage = $team->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/team";
            $imageName = uniqid().$image->getClientOriginalName();
            $team->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $team->image);
        }
        $team->save();

        return back()->with('statusInput', 'Team successfully edited');
    }

    public function destroy($id){
        $team = Team::find($id);
        $team->delete();

        return back()->with('statusInput', 'Team successfully deleted');
    }
}
