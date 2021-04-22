<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileUser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        $user = User::find(Auth::user()->id);

        return view('admin.profile', compact('user'));
    }

    public function profileStore(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'image' => 'image',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user_id = Auth::user()->id;

        $user = User::find($user_id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->image){
            $oldImage = $user->image;
            File::delete($oldImage);
            $image = $request->file('image');
            $imageLocation = "assets/image/user/".$user_id."/";
            $imageName = $image->getClientOriginalName();
            $user->image = $imageLocation."/".$imageName;
            $image->move($imageLocation, $user->image);    
        }

        $user->save();

        return back()->with('statusInput', 'Profile Successfully Edited');
    }

    public function profileChangePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->password = Hash::make($request->password);

        Auth::logout();
        return back()->with('statusInput', 'Password Successfully Changed');
    }
}
