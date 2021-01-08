<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Purchase;
use App\Purchase_detail;
use App\Supplier;
use App\Stuff;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {  
            if (Auth::user()->jabatan !== "ADMINISTRATOR" && Auth::user()->jabatan !== "LOGISTIK") {
                abort(404);
            }
            return $next($request);
        });
    }
    public function index(){
        $suppliers = Supplier::all();
        $stuffs = Stuff::all();
        $prefix = "TB";  
        $purchase_code = IdGenerator::generate(['table' => 'pembelian','field'=>'kode_pembelian', 'length' => 5, 'prefix' =>$prefix]);
        return view('purchase/purchase', ['purchase_code'=> $purchase_code, 'suppliers' => $suppliers, 'stuffs'=>$stuffs]);
    }

    public function store(Request $request){
        $user = Auth::user()->username;
        $prefix = "TB";  
        $purchase_code = IdGenerator::generate(['table' => 'pembelian','field'=>'kode_pembelian', 'length' => 5, 'prefix' =>$prefix]);
        $stuffs = json_decode($request->data);

        if(!$stuffs){
            return redirect('/purchase')->with('error', 'Tidak ada barang dipilih');
        }


        Purchase::create([
            'kode_pembelian' => $purchase_code,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'tanggal_dibuat' => $request->tanggal_pembelian,
            'kode_supplier' => $request->kode_supplier,
            'total_biaya' => $request->harga,
            'dibuat_oleh' => $user
        ]);


        foreach( $stuffs as $data){
            $dataDb = Stuff::where('kode_barang', $data->kode_barang)->get();
            $newStok = $dataDb[0]->stok + $data->jumlah;

            Stuff::where('kode_barang', $data->kode_barang)
            ->update([
                'stok' => $newStok
            ]);

            Purchase_detail::create([
                'kode_pembelian' => $purchase_code,
                'kode_barang' => $data->kode_barang,
                'harga_satuan' => $data->harga_satuan,
                'jumlah' => $data->jumlah
            ]);
        }

        return redirect('/purchase')->with('status', 'Pembelian berhasil ditambahkan');
    }
}
