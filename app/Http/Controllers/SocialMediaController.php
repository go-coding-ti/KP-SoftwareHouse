<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\SocialMedia;
class SocialMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $socialMedias = SocialMedia::all();
        return view('admin.social_media',compact('socialMedias'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'url' => 'required|min:5',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $socialMedia = new SocialMedia;
        $socialMedia->name = $request->name;
        $socialMedia->url = $request->url;
        $image = $request->file('image');
        $imageLocation = "assets/image/social-media";
        $imageName = $image->getClientOriginalName();
        $socialMedia->image = $imageLocation."/".$imageName;
        $image->move($imageLocation, $socialMedia->image);
        $socialMedia->save();

        return back()->with('statusInput', 'Social media successfully added to record');
    }

    public function edit($id){
        $socialMedia = SocialMedia::find($id);
        return response()->json(['success' => 'Berhasil', 'socialMedia' => $socialMedia]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'url' => 'required|min:5',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $socialMedia = SocialMedia::find($id);

        $socialMedia->name = $request->name;
        $socialMedia->url = $request->url;
        if($request->image != null){
            $oldImage = $socialMedia->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/social-media";
            $imageName = $image->getClientOriginalName();
            $socialMedia->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $socialMedia->image);
        }
        $socialMedia->save();

        return back()->with('statusInput', 'Social media successfully edited');
    }

    public function destroy($id){
        $socialMedia = SocialMedia::find($id);
        $socialMedia->delete();
        return redirect(route('social-media'));
        return back()->with('statusInput', 'Social media successfully deleted');
    }
}
