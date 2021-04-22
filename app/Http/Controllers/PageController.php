<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\PageImage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $pages = Page::all();
        return view('admin.page.page', compact('pages'));
    }

    public function create(){
        return view('admin.page.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'content' => 'required|min:8',
            'title_en' => 'required|min:3',
            'content_en' => 'required|min:8',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $arrImage = [];
        $arrImage_en = [];

        $page = new Page;
        $page->title = $request->title;
        $page->title_en = $request->title_en;
        
        //content ina
        $detail = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/page/'.$page->title.'/ina/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }
        }

        $detail = $dom->savehtml();
        $page->content = $detail;

        //content_en
        $detail_en = $request->content_en;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/page/'.$page->title.'/en/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage_en, $path);
            }
        }

        $detail_en = $dom->savehtml();
        $page->content_en = $detail_en;
        $page->save();

        foreach($arrImage as $item){
            $pageImage = new PageImage;
            $pageImage->id_page = $page->id_page;
            $pageImage->image = $item;
            $pageImage->type_content = 'id';
            $pageImage->save();
        }

        foreach($arrImage_en as $item){
            $pageImage = new PageImage;
            $pageImage->id_page = $page->id_page;
            $pageImage->image = $item;
            $pageImage->type_content = 'en';
            $pageImage->save();
        }

        return redirect(route('page'))->with('statusInput','Page berhasil dimasukkan');
    }

    public function show($id){
        $page = Page::find($id);

        return view('admin.page.show', compact('page'));
    }

    public function edit($id){
        $page = Page::find($id);

        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'content' => 'required|min:8',
            'title_en' => 'required|min:3',
            'content_en' => 'required|min:8',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $page = Page::find($id);
        $arrImage = [];
        $arrImage_en = [];
        $idImage = [];
        $idImage_en = [];

        $page->title = $request->title;
        $page->title_en = $request->title_en;
        $pageImage = PageImage::where('id_page','=', $id)->where('type_content','=','id')->get();
        
        $detail = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        //variabel dummy
            $arrsrc = [];
            $arrfoto = [];
            $status = '';
        //variabel dummy

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/page/'.$page->title.'/ina/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }

            if($pageImage != null){
                foreach($pageImage as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage, $item->id_page_image);
                    break;
                    }
                }   
            }
            
        }

        $pageImages = PageImage::whereNotIn('id_page_image', $idImage)->where('id_page',$id)->where('type_content','id')->get();
        PageImage::whereNotIn('id_page_image', $idImage)->where('id_page',$id)->where('type_content','id')->delete();
        foreach($pageImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail = $dom->savehtml();
        $page->content = $detail;

        //content_eng
        $pageImage_en = PageImage::where('id_page','=', $id)->where('type_content','=','en')->get();
        $detail_en = $request->content_en;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail_en, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        //variabel dummy
            $arrsrc = [];
            $arrfoto = [];
            $status = '';
        //variabel dummy

        
        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/image/page/'.$page->title.'/en/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage_en, $path);
            }

            if($pageImage_en != null){
                foreach($pageImage_en as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage_en, $item->id_page_image);
                    break;
                    }
                }   
            }
            
        }

        

        $pageImages = PageImage::whereNotIn('id_page_image', $idImage_en)->where('id_page',$id)->where('type_content','en')->get();
        PageImage::whereNotIn('id_page_image', $idImage_en)->where('id_page',$id)->where('type_content','en')->delete();
        foreach($pageImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail_en = $dom->savehtml();
        $page->content_en = $detail_en;

        $page->save();

        foreach($arrImage as $item){
            $pageImage = new PageImage;
            $pageImage->id_page = $page->id_page;
            $pageImage->image = $item;
            $pageImage->type_content = 'id';
            $pageImage->save();
        }

        foreach($arrImage_en as $item){
            $pageImage = new PageImage;
            $pageImage->id_page = $page->id_page;
            $pageImage->image = $item;
            $pageImage->type_content = 'en';
            $pageImage->save();
        }
        
        return redirect(route('page'))->with('statusInput', 'Page successfully edited');
    }

    public function destroy($id){
        $page = Page::find($id);
        $page->delete();
        return back()->with(['statusInput' => 'Successfully delete news']);
    }
}
