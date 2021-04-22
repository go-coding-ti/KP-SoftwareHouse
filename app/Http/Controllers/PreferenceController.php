<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Preference;

class PreferenceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $preference = Preference::first();
        return view('admin.preference', compact('preference'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'web_name' => 'required|min:3',
            'logo_image' => 'image',
            'banner_content_ina' => 'required|min:8',
            'banner_content_eng' => 'required|min:8',
            'address_ina' => 'required|min:8',
            'address_eng' => 'required|min:8',
            'link_video' => 'required',
            'video_description_in' => 'required|min:8',
            'video_description_en' => 'required|min:8',
            'banner_image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $preference = Preference::first();
        $preference->web_name = $request->web_name;
        $preference->banner_content_ina = $request->banner_content_ina;
        $preference->banner_content_eng = $request->banner_content_eng;
        $preference->address_ina = $request->address_ina;
        $preference->address_eng = $request->address_eng;
        $preference->link_video = $request->link_video;
        $preference->video_description_in = $request->video_description_in;
        $preference->video_description_en = $request->video_description_en;

        if($request->logo_image){
            $image = $request->file('logo_image');
            $imageLocation = "assets/image/preference";
            $imageName = $image->getClientOriginalName();
            $preference->logo_img = $imageLocation."/".$imageName;
            $image->move($imageLocation, $preference->logo_img);    
        }

        if($request->banner_image){
            $image = $request->file('banner_image');
            $imageLocation = "assets/image/preference";
            $imageName = $image->getClientOriginalName();
            $preference->banner_img = $imageLocation."/".$imageName;
            $image->move($imageLocation, $preference->banner_img);    
        }

        $preference->save();

        return back()->with('statusInput', 'Successfully Updated Preference');
    }
}
