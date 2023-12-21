<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    //method untuk tampilkan data index
    public function index(){
        $pembelis = Pembeli::latest()->when(request()->q, function($pembelis){
             $pembelis = $pembelis->where ("nama_pembeli", "like", "%". request()->q ."%");
        })->paginate(10);
        return view("admin.pembeli.index", compact("pembelis"));
    }

    //UNTUK MEMBUAT TAMBAH DATA
    public function create(){
        return view("admin.pembeli.create");
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "nama_pembeli"=> "required|:pembelis",
            "alamat"=> "required|:pembelis",
            "no_hp"=> "required|:pembelis",
            
        ]);

        // data inputan simpan ke dalam table
        $pembeli = Pembeli::create([
            'nama_pembeli'=> $request->nama_pembeli,
            'alamat'=> $request->alamat,
            'no_hp'=> $request->no_hp,
        ]);

        // kondisi
        if($pembeli){
            return redirect()->route('admin.pembeli.index')->with(['success'=>'data berhasil di tambah ke dalam table pembeli']);
        }else{
            return redirect()->route('admin.pembeli.index')->with(['error'=>'data Gagal di tambah ke dalam table pembeli']);
        }
    }

        //UNTUK EDIT DATA PEMBELI
     public function edit(Pembeli $pembeli){
        return view('admin.pembeli.edit', compact('pembeli'));
    }

        //method untuk mengirimkan data yang di ubah ke dalam table pembelis
        public function update(Request $request, Pembeli $pembeli){
            //validasi data
            $this->validate($request, [
                'nama_pembeli'=> 'required|:pembelis,nama_pembeli,' .$pembeli->id,
                'alamat'=> 'required|:pembelis,alamat,' .$pembeli->id,
                'no_hp'=> 'required|:pembelis,no_hp,' .$pembeli->id,
            ]);
    
                //upload data di table kategori dengan data baru
                $pembeli = Pembeli::findOrFail($pembeli->id_pembeli);
                $pembeli->update([
                    'nama_pembeli' => $request->nama_pembeli,
                    'alamat' => $request->alamat,
                    'no_hp' => $request->no_hp,
                   
                ]);
            
            //kondisi untuk penanda berhasil atau tidak dengan memberikan pop up
            if($pembeli){
                return redirect()->route('admin.pembeli.index')->with(['success'=> 'Data Berhasil Di Ubah Ke Dalam Table pembeli']);
            }else {
                return redirect()->route('admin.pembeli.index')->with(['error'=> 'Data Gagal Di Ubah Ke Dalam Table pembeli']);
            }
        }

        //UNTUK MENGHAPUS DATA
         
    public function destroy($id){
        $pembeli = Pembeli::findOrFail($id);
        $pembeli->delete();

        //kondisi dalam hapus
        if($pembeli){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'error']);
        }

    }
}
