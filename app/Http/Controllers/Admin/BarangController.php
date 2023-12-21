<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //method untuk tampilkan data index
    public function index(){
        $barangs = Barang::latest()->when(request()->q, function($barangs){
             $barangs = $barangs->where ("nama_barang", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.barang.index", compact("barangs"));
    }

    //UNTUK MEMBUAT TAMBAH DATA
    public function create(){
        return view("admin.barang.create");
    }

    //bagian untuk menambahkan data
    public function store(Request $request){
      
        $this->validate($request, [
            "nama_barang"=> "required|:barangs",
            "satuan"=> "required|:barangs",
            "harga"=> "required|:barangs",
            
        ]);

        // data inputan simpan ke dalam table
        $barang = Barang::create([
            'nama_barang'=> $request->nama_barang,
            'satuan'=> $request->satuan,
            'harga'=> $request->harga,
        ]);

        // kondisi
        if($barang){
            return redirect()->route('admin.barang.index')->with(['success'=>'data berhasil di tambah ke dalam table barang']);
        }else{
            return redirect()->route('admin.barang.index')->with(['error'=>'data Gagal di tambah ke dalam table barang']);
        }
    }

        //UNTUK EDIT DATA barang
     public function edit(Barang $barang){
        return view('admin.barang.edit', compact('barang'));
    }

        //method untuk mengirimkan data yang di ubah ke dalam table barangs
        public function update(Request $request, Barang $barang){
            //validasi data
            $this->validate($request, [
                'nama_barang'=> 'required|:barangs,nama_barang,' .$barang->id,
                'satuan'=> 'required|:barangs,satuan,' .$barang->id,
                'harga'=> 'required|:barangs,harga,' .$barang->id,
            ]);
    
                //upload data di table kategori dengan data baru
                $barang = Barang::findOrFail($barang->id_barang);
                $barang->update([
                    'nama_barang' => $request->nama_barang,
                    'satuan' => $request->satuan,
                    'harga' => $request->harga,
                   
                ]);
            
            //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
            if($barang){
                return redirect()->route('admin.barang.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table barang']);
            }else {
                return redirect()->route('admin.barang.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table barang']);
            }
        }

        //UNTUK MENGHAPUS DATA
         
    public function destroy($id){
        $barang = Barang::findOrFail($id);
        $barang->delete();

        //kondisi dalam hapus
        if($barang){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }

    }
}
