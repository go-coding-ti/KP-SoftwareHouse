<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Project;
use App\ProjectTrial;

class ProjectTrialController extends Controller
{
    public function index(){
        $projectTrials = ProjectTrial::all();
        $id_projects = ProjectTrial::pluck('id_project');
        $projects = Project::whereNotIn('id_project',$id_projects)->get();

        return view('admin.project_trial', compact('projects', 'projectTrials'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id_project' => 'required',
            'url' => 'required'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $projectTrial = new ProjectTrial;
        $projectTrial->id_project = $request->id_project;
        $projectTrial->url = $request->url;
        $projectTrial->save();

        return back()->with('statusInput', 'project trial successfully added to record');
    }

    public function edit($id){
        $projectTrial = ProjectTrial::with('project')->find($id);
        $id_projects = ProjectTrial::pluck('id_project');
        $id_project = $projectTrial->id_project;
        $arr_project = [];

        foreach($id_projects as $idp){
            if($idp != $projectTrial->id_project){
                array_push($arr_project, $idp);
            }
        }

        $projects = Project::whereNotIn('id_project',$arr_project)->get();
        $view = view('admin.blog.blogCategory', compact('projects', 'id_project'))->render();

        return response()->json(['success' => 'Berhasil', 'project_trial' => $projectTrial,'dummy' => $view]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'id_project' => 'required',
            'url' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $projectTrial = ProjectTrial::find($id);

        $projectTrial->id_project = $request->id_project;
        $projectTrial->url = $request->url;
        $projectTrial->save();

        return back()->with('statusInput', 'project trial successfully edited');
    }

    public function destroy($id){
        $projectTrial = ProjectTrial::find($id);
        $projectTrial->delete();
        return back()->with('statusInput', 'project trial successfully deleted');
    }
}
