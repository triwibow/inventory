<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use App\Stuff;

class StuffController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {  
            if (Auth::user()->jabatan !== "ADMINISTRATOR") {
                abort(404);
            }
            return $next($request);
        });
    }
    public function index(){
        $prefix = "B";  
        $stuff_code = IdGenerator::generate(['table' => 'master_barang','field'=>'kode_barang', 'length' => 4, 'prefix' =>$prefix]);
        $stuffs = Stuff::all();
        return view('stuff/stuff',['stuffs' => $stuffs, 'stuff_code'=>$stuff_code]);
    }

    public function store(Request $request){
        $prefix = "B";  
        $stuff_code = IdGenerator::generate(['table' => 'master_barang','field'=>'kode_barang', 'length' => 4, 'prefix' =>$prefix]);
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi_barang' => 'required',
            'harga_satuan' => 'required|numeric'
        ]);

        Stuff::create([
            'kode_barang' => $stuff_code,
            'nama_barang' => $request->nama_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'harga_satuan' => $request->harga_satuan,
            'stok'=> 0
            
        ]);

        return redirect('/stuff')->with('status', 'Barang berhasil ditambahkan');
    }

    public function edit(Request $request, Stuff $stuff){
        return view('stuff/edit', ['stuff' => $stuff]);
    }

    public function update(Request $request, Stuff $stuff){
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi_barang' => 'required',
            'harga_satuan' => 'required|numeric'
        ]);
        
        Stuff::where('kode_barang', $stuff->kode_barang)
            ->update([
                'nama_barang' => $request->nama_barang,
                'deskripsi_barang' => $request->deskripsi_barang,
                'harga_satuan' => $request->harga_satuan,
            ]);
        return redirect('stuff/'.$stuff->kode_barang.'/edit')->with('status', 'Barang berhasil diupdate');

    }

    public function destroy(Stuff $stuff){
        Stuff::destroy($stuff->kode_barang);
        return redirect('/stuff')->with('status', 'Barang berhasil dihapus');
    }
}
