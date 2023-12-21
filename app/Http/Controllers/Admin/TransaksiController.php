<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //method untuk tampilkan data index
    public function index(){
        $transaksis = Transaksi::latest()->when(request()->q, function($transaksis){
             $transaksis = $transaksis->where ("id_pembeli", "like", "%". request()->q ."%");
        })->paginate(10);
        $transaksis = Transaksi::with(['pembeli','barang'])->paginate(10);
        return view("admin.transaksi.index", compact("transaksis"));
    }

       //UNTUK MEMBUAT TAMBAH DATA
       public function create()
    {
        $pembelis = Pembeli::all();
        $barangs = Barang::all();
        return view("admin.transaksi.create", compact ('barangs', 'pembelis'));
    }

    //  method store untuk tambah data pada kategory
    public function store(Request $request){
        // validasi inputan
        $this->validate($request, [
            "id_pembeli"=> "required|exists:pembelis,id_pembeli",
            "id_barang"=> "required|exists:barangs,id_barang",
            "jumlah"=> "required|integer|min:1", 
        ]);

        //Ini untuk mencari total harga
        $barangs = Barang::findOrFail($request->id_barang);
        $harga = $barangs->harga * $request->jumlah;
    

        // data inputan simpan ke dalam table
        $transaksi = Transaksi::create([
            'id_pembeli'=> $request->id_pembeli,
            'id_barang'=> $request->id_barang,
            'jumlah'=> $request->jumlah,
            'harga'=> $harga,
        ]);

        // kondisi
        if($transaksi){
            return redirect()->route('admin.transaksi.index')->with(['success'=>'data berhasil di tambah ke dalam table transaksi']);
        }else{
            return redirect()->route('admin.transaksi.index')->with(['error'=>'data Gagal di tambah ke dalam table transaksi']);
        }

    }

    //UNTUK EDIT DATA PEMBELI
     public function edit(Transaksi $transaksi)
     {
         $transaksi = Transaksi::findOrFail($transaksi->id_transaksi);
         $pembelis = Pembeli::all();
         $barangs = Barang::all();
 
         return view('admin.transaksi.edit', compact('transaksi', 'pembelis', 'barangs'));
 
     }
 
     // Menyimpan data transaksi yang sudah diubah
     public function update(Request $request, Transaksi $transaksi)
     {
         $request->validate([
             'id_pembeli' => 'required|exists:pembelis,id_pembeli',
             'id_barang' => 'required|exists:barangs,id_barang',
             'jumlah' => 'required|integer|min:1',
         ]);
     
         $transaksi = Transaksi::findOrFail($transaksi->id_transaksi);
     
         // Hitung harga berdasarkan jumlah dan harga barang
         $barang = Barang::findOrFail($request->id_barang);
         $harga = $barang->harga * $request->jumlah;
     
         // Update data transaksi
         $transaksi->update([
             'id_pembeli' => $request->id_pembeli,
             'id_barang' => $request->id_barang,
             'jumlah' => $request->jumlah,
             'harga' => $harga, // Simpan harga di sini
             // Sesuaikan kolom lainnya sesuai kebutuhan
         ]);
 
         // Redirect ke halaman index dengan pesan sukses
         if($transaksi){
             return redirect()->route('admin.transaksi.index')->with(['success'=>'data berhasil di tambah ke dalam table kategori']);
         }else{
             return redirect()->route('admin.transaksi.index')->with(['error'=>'data Gagal di tambah ke dalam table kategori']);
         }
     }
 

        public function destroy($id){
            $transaksi = Transaksi::findOrFail($id);
            $transaksi->delete();
    
            //kondisi dalam hapus
            if($transaksi){
                return response()->json(['status'=> 'success']);
            }else{
                return response()->json(['status'=> 'error']);
            }
        }
}
