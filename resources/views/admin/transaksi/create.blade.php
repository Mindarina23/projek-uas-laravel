@extends('layouts.app', ['title' => 'Tambah transaksi - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">TAMBAH TRANSAKSI</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.transaksi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
                    
                    
                    <div>
                        <label class="text-gray-700" for="id_pembeli">PEMBELI</label>
                        <select name="id_pembeli" id="id_pembeli" class="form-select w-full">
                            @foreach($pembelis as $pembeli)
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <option value="{{$pembeli->id_pembeli}}">{{$pembeli->nama_pembeli}}</option>
                            @endforeach
                        </select>
                        @error('id_pembeli')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="id_barang">BARANG</label>
                        <select name="id_barang" id="id_barang" class="form-select w-full">
                            @foreach($barangs as $barang)
                            <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                <option value="{{$barang->id_barang}}">{{$barang->nama_barang}}</option>
                            @endforeach
                        </select>
                        @error('id_barang')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-700" for="jumlah">JUMLAH</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="jumlah" value="{{ old('jumlah') }}" placeholder="jumlah transaksi">
                        @error('jumlah')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection