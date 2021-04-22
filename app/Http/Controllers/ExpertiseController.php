<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use App\Expertise;

class ExpertiseController extends Controller
{
    /**
     * fungsi construct merupakan fungsi paling awal dijalankan dan berfungsi untuk menjalankan
     * middleware auth, agar admin saja yang dapat mengakses
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * fungsi index merupakan fungsi yang ditujukan untuk menampilkan view html untuk
     * menampilkan page awal untuk manajemen data expertise
     */  
    public function index(){
        $expertises = Expertise::all();
        return view('admin.expertise', compact('expertises'));
    }

    /**
     * fungsi store berfungsi untuk menyimpan data kedalam database sesuai dengan isi
     * dari variable request. Terdapat perintah validator untuk melakukan validasi
     * terhadap masukan yang diberikan oleh sistem agar sesuai dengan kebutuhan yang diperlukan.
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'description_en' => 'required|min:8',
            'image' => 'required|image'
        ]);

        if($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }

        $expertise = new Expertise;
        $expertise->name = $request->name;
        $expertise->description = $request->description;
        $expertise->description_en = $request->description_en;

        //Proses mengirimkan gambar ke server
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imageLocation = 'assets/image/expertise';
        $expertise->image = $imageLocation.'/'.$imageName;
        $image->move($imageLocation, $imageName);

        $expertise->save();

        return back()->with('statusInput', 'Expertise successfully added');
    }

    /**
     * fungsi edit merupakan fungsi untuk memberikan hasil akhir berupa json, dikarenakan
     * fungsi ini akan dipanggil oleh ajax. Fungsi ini akan me-return nilai dari salah satu
     * news kategory.
     */
    public function edit($id){
        $expertise = Expertise::find($id);
        return response()->json(['success' => 'berhasil', 'expertise' => $expertise]);
    }

    /**
     * fungsi update sama hampir sama dengan fungsi store,hanya saja fungsi update perlu
     * parameter id sebagai kunci untuk mengubah data yang diinginkan.
     */
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'description' => 'required|min:8',
            'description_en' => 'required|min:8',
            'image' => 'image'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $expertise = Expertise::find($id);

        $expertise->name = $request->name;
        $expertise->description = $request->description;
        $expertise->description_en = $request->description_en;

        //proses menghapus dan mengganti gambar dengan data gambar yang baru pada server dan database server
        if($request->image){
            $oldImage = $expertise->image;
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imageLocation = 'assets/image/expertise';
            File::delete($oldImage);
            $expertise->image = $imageLocation.'/'.$imageName;
            $image->move($imageLocation,$imageName);
        }
        $expertise->save();
        return back()->with('statusInput', 'Expertise successfully updated');
    }

    /**
     * fungsi destroy merupakan fungsi yang digunakan untuk menghapus data expertise yang
     * berdasarkan parameter id yang diinginkan.
     */
    public function destroy($id){
        $expertise = Expertise::find($id);
        $expertise->delete();
        return back()->with('statusInput', 'Expertise successfully deleted');
    }
}
