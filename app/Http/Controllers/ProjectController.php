<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Project;
use App\Expertise;
use App\DetailExpertiseProject as DEP;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $projects = Project::with('expertise')->get();
        $expertises = Expertise::all();
        return view('admin.project',compact('projects','expertises'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'expertise' =>'required',
            'instansi' =>'required',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->instansi = $request->instansi;
        $image = $request->file('image');
        $imageLocation = "assets/image/project";
        $imageName = $image->getClientOriginalName();
        $project->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $project->image);
        $project->save();

        foreach($request->expertise as $id_expertise){
            $dep = new DEP;
            $dep->id_project = $project->id_project;
            $dep->id_expertise = $id_expertise;
            $dep->save();
        }

        return back()->with('statusInput', 'project successfully added to record');
    }

    public function edit($id){
        $project = Project::with('expertise')->find($id);
        $expertise = DEP::where('id_project','=',$id)->get();
        $expertises = '';
        foreach($project->expertise as $item){
            $expertises = $expertises.$item->name.',';
        }
        $expertises = substr($expertises, 0, -1);
        $arrexpertise = [];

        foreach($expertise as $item){
            array_push($arrexpertise,$item->id_expertise);
        }

        return response()->json(['success' => 'Berhasil', 'project' => $project, 'expertise' => $arrexpertise, 'expertises' => $expertises]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'expertise' =>'required',
            'instansi' =>'required',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $project = Project::find($id);
        $deletedExpertises = DEP::where('id_project',$id)->delete();

        $project->name = $request->name;
        $project->description = $request->description;
        $project->instansi = $request->instansi;
        if($request->image != null){
            $oldImage = $project->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/project";
            $imageName = $image->getClientOriginalName();
            $project->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $project->image);
        }
        $project->save();

        foreach($request->expertise as $id_expertise){
            $dep = new DEP;
            $dep->id_project = $project->id_project;
            $dep->id_expertise = $id_expertise;
            $dep->save();
        }

        return back()->with('statusInput', 'project successfully edited');
    }

    public function destroy($id){
        $project = Project::find($id);
        $project->delete();
        return redirect(route('project'));
    }
}

