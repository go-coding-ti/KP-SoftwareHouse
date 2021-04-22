<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use App\User;

class ManagementUser extends Controller
{
    private $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isSuperAdmin');
    }

   public function index(){
       $users = User::where('type',0)->get();
       return view('admin.user', compact('users'));
   }

   public function edit($id){
       $user = User::find($id);
       return response()->json(['success' => 'berhasil', 'user' => $user]);
   }

   public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = 0;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('statusInput', 'Admin successfully created');
   }

   public function update(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            if($request->password != $request->password_confirmastion || strlen($request->password) < 8){
                return back()->withErrors('Format password is wrong, minimal 8 character or the confirm password doesnt match');
            }else{
                $user->password = Hash::make($request->password);
            }
        }
        $user->save();

        return back()->with('statusInput', 'Admin successfully edited');
   }

   public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return back()->with('statusInput', 'Admin successfully deleted');
   }

   public function typeChange($id){
        $user = User::find($id);
        $user->type = 1;
        $user->save();
        return response()->json(['berhasil' => 'success']);
   }
}
