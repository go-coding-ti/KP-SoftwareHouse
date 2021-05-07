<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AboutUs;
use App\CompanyProfileImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $aboutUs = AboutUs::first();
        return view('admin.about-us', compact('aboutUs'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'description_ina' => 'required|min:8',
            'description_eng' => 'required|min:8',
            'link_video' => 'required',
            'video_description_ina' => 'required|min:8',
            'video_description_eng' => 'required|min:8',
            'file_profile_company' => 'mimes:pdf'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $aboutUs = AboutUs::first();
        $arrImage = [];
        $arrImage_eng = [];
        $idImage = [];
        $idImage_eng = [];
        $id = $aboutUs->id_about_us;
        // $aboutUs->description_ina = $request->description_ina;
        // $aboutUs->description_eng = $request->description_eng;
        $aboutUs->link_video = $request->link_video;
        $aboutUs->video_description_ina = $request->video_description_ina;
        $aboutUs->video_description_eng = $request->video_description_eng;

        /**
         * Memasukkan seluruh gambar pada konten blog dalam variabel yang nantinya akan dilakukan
         * proses pencocokan, apakah gambar tetap terpakai dalam konten atau dihapus nantinya.
         */
        $aboutImage = CompanyProfileImage::where('id_about_us','=', $aboutUs->id_about_us)->where('type_content','=','id')->get();
        
        $detail = $request->description_ina;
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
                $path = '/image/about-us/company-profile/'.uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage, $path);
            }

            /**
             * Proses pencocokan alamat direktori gambar pada request konten blog dengan yang ada
             * dalam database. Jika kedua hal tersebut sesuai maka gambar masih digunakan dan akan 
             * disimpan dalam database yang nantinya menjadi kunci untuk menghapus gambar yang sudah
             * tidak digunakan lagi dalam konten.
             * Begitu pula dengan konten english.
             */
            if($aboutImage != null){
                foreach($aboutImage as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage, $item->id_company_profile_image);
                    break;
                    }
                }   
            }
            
        }

        /**
         * Proses mencari gambar yang tidak terdapat dalam array dalam database dan data tersebut
         * yang merupakan asset dari gambar akan terhapus, dikarenakan sudah tidak digunakan lagi
         * dalam konten news tersebut.
         */
        $aboutImages = CompanyProfileImage::whereNotIn('id_company_profile_image', $idImage)->where('id_about_us',$id)->where('type_content','id')->get();
        CompanyProfileImage::whereNotIn('id_company_profile_image', $idImage)->where('id_about_us',$id)->where('type_content','id')->delete();
        foreach($aboutImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail = $dom->savehtml();
        $aboutUs->description_ina = $detail;

        //content_eng
        $aboutImage_eng = CompanyProfileImage::where('id_about_us','=', $id)->where('type_content','=','en')->get();
        $detail_eng = $request->description_eng;
        libxml_use_internal_errors(true);
        $dom = new \domdocument();
        $dom->loadHtml($detail_eng, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
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
                $path = '/image/about-us/company-profile/'. uniqid('', true) . '.' . $mimeType;
                Storage::disk('public')->put($path, file_get_contents($src));
                $image->removeAttribute('src');
                $link = asset('storage'.$path);
                $image->setAttribute('src', $link);
                array_push($arrImage_eng, $path);
            }

            if($aboutImage_eng != null){
                foreach($aboutImage_eng as $item){
                    $src = str_replace('/',' ',$src);
                    $item->image = str_replace(' ','%20',$item->image);
                    $item->image = str_replace('/', ' ',$item->image);
                    array_push($arrsrc, $src);
                    array_push($arrfoto, $item->image);
                    if(preg_match('/'.$item->image.'/',$src)){
                        array_push($arrsrc, 'true');
                        array_push($idImage_eng, $item->id_company_profile_image);
                    break;
                    }
                }   
            }
            
        }

        

        $aboutImages = CompanyProfileImage::whereNotIn('id_company_profile_image', $idImage_eng)->where('id_about_us',$id)->where('type_content','en')->get();
        CompanyProfileImage::whereNotIn('id_company_profile_image', $idImage_eng)->where('id_about_us',$id)->where('type_content','en')->delete();
        foreach($aboutImages as $item){
            Storage::disk('public')->delete($item->image);
        }

        $detail_eng = $dom->savehtml();
        $aboutUs->description_eng = $detail_eng;

         /*
            Proses memasukkan asset gambar dalam array ke dalam database, agar mudah dikelola
            seperti penghapusan gambar dari server. Sama untuk kedua foreach. Jika ingin meringkas
            kode, pembaca kode ini jika berkenan bisa membuatkan fungsi baru agar lebih ringkas.
            Terimakasih.
         */
        foreach($arrImage as $item){
            $aboutUsImage = new CompanyProfileImage;
            $aboutUsImage->id_about_us = $aboutUs->id_about_us;
            $aboutUsImage->image = $item;
            $aboutUsImage->type_content = 'id';
            $aboutUsImage->save();
        }

        foreach($arrImage_eng as $item){
            $aboutUsImage = new CompanyProfileImage;
            $aboutUsImage->id_about_us = $aboutUs->id_about_us;
            $aboutUsImage->image = $item;
            $aboutUsImage->type_content = 'en';
            $aboutUsImage->save();
        }


        //file pdf
        if($request->file_profile_company){
            File::delete($aboutUs->file_profile_company);
            $file = $request->file('file_profile_company');
            $fileLocation = "assets/about-us/profile-company";
            $fileName = $file->getClientOriginalName();
            $aboutUs->file_profile_company = $fileLocation."/".$fileName;
            $file->move($fileLocation, $aboutUs->file_profile_company);   
        }


        $aboutUs->save();

        return back()->with('statusInput', 'Successfully Updated Preference');
    }
}
