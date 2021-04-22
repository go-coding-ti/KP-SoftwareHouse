<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $menus = Menu::with('page')->get();
        $pages = Page::all();
        return view('admin.menu', compact('menus','pages'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'type_page' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $menu = new Menu;
        $menu->name = $request->name;

        if($request->type_page == 1){
            $menu->url = null;
            if($request->id_page){
                $menu->id_page = $request->id_page;
            }else{
                return back()->withErrors('Internal Page Cannot be null');
            }
        }else{
            if($request->url){
                $menu->url = $request->url;
            }else{
                return back()->withErrors('External URL Cannot be null');
            }
            $menu->id_page = null;
        }

        $menu->save();

        return back()->with('statusInput','Successfully Added Additional Menu');
    }

    public function edit($id){
        $menu = Menu::with('page')->find($id);

        return response()->json(['success' => 'berhasil', 'menu' => $menu]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'type_page' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $menu = Menu::find($id);

        $menu->name = $request->name;
        if($request->type_page == 1){
            $menu->url = null;
            if($request->id_page){
                $menu->id_page = $request->id_page;
            }else{
                return back()->withErrors('Internal Page Cannot be null');
            }
        }else{
            if($request->url){
                $menu->url = $request->url;
            }else{
                return back()->withErrors('External URL Cannot be null');
            }
            $menu->id_page = null;
        }

        $menu->save();

        return back()->with('statusInput', 'Menu Successfully Edited');
    }

    public function destroy($id){
        $menu = Menu::find($id);
        $menu->delete();

        return back()->with('statusInput', 'Mennu Successfully Deleted');
    }
}
