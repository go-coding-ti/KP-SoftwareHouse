<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SubMenu;
use App\Menu;
use App\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SubMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $submenus = SubMenu::with('page','menu')->get();
        $menus = Menu::all();
        $pages = Page::all();
        return view('admin.submenu', compact('submenus','menus','pages'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'id_menu' => 'required',
            'type_page' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $submenu = new SubMenu;
        $submenu->name = $request->name;
        $submenu->id_menu = $request->id_menu;
    

        if($request->type_page == 1){
            $submenu->url = null;
            if($request->id_page){
                $submenu->id_page = $request->id_page;
            }else{
                return back()->withErrors('Internal Page Cannot be null');
            }
        }else{
            if($request->url){
                $submenu->url = $request->url;
            }else{
                return back()->withErrors('External URL Cannot be null');
            }
            $submenu->id_page = null;
        }

        $submenu->save();

        return back()->with('statusInput','Successfully Added Additional Sub Menu');
    }

    public function edit($id){
        $submenu = SubMenu::with('page','menu')->find($id);

        return response()->json(['success' => 'berhasil', 'submenu' => $submenu]);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'id_menu' => 'required',
            'type_page' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $submenu = SubMenu::find($id);

        $submenu->name = $request->name;
        $submenu->id_menu = $request->id_menu;
        if($request->type_page == 1){
            $submenu->url = null;
            if($request->id_page){
                $submenu->id_page = $request->id_page;
            }else{
                return back()->withErrors('Internal Page Cannot be null');
            }
        }else{
            if($request->url){
                $submenu->url = $request->url;
            }else{
                return back()->withErrors('External URL Cannot be null');
            }
            $submenu->id_page = null;
        }

        $submenu->save();

        return back()->with('statusInput', 'Sub Menu Successfully Edited');
    }

    public function destroy($id){
        $submenu = SubMenu::find($id);
        $submenu->delete();

        return back()->with('statusInput', 'Mennu Successfully Deleted');
    }

}
