<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
use App\Sales_detail;
use App\Customer;
use App\Stuff;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {  
            if (Auth::user()->jabatan !== "ADMINISTRATOR" && Auth::user()->jabatan !== "FAKTURIS") {
                abort(404);
            }
            return $next($request);
        });
    }
    public function index(){
        
        $customers = Customer::all();
        $stuffs = Stuff::all();
        $prefix = "TJ";  
        $sales_code = IdGenerator::generate(['table' => 'penjualan','field'=>'kode_penjualan', 'length' => 5, 'prefix' =>$prefix]);
        return view('sales/sales', ['sales_code'=> $sales_code, 'customers' => $customers, 'stuffs'=>$stuffs]);
    }

    public function store(Request $request){
        $user = Auth::user()->username;
        $prefix = "TJ";  
        $sales_code = IdGenerator::generate(['table' => 'penjualan','field'=>'kode_penjualan', 'length' => 5, 'prefix' =>$prefix]);
        $stuffs = json_decode($request->data);

        if(!$stuffs){
            return redirect('/sales')->with('error', 'Tidak ada barang dipilih');
        }

        foreach( $stuffs as $data){
            $dataDb = Stuff::where('kode_barang', $data->kode_barang)->get();
            $newStok = $dataDb[0]->stok + $data->jumlah;

            if($dataDb[0]->stok < $data->jumlah){

                return redirect('/sales')->with('error', 'Stok tidak cukup');
            }
        }

        Sales::create([
            'kode_penjualan' => $sales_code,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'tanggal_dibuat' => $request->tanggal_penjualan,
            'kode_pelanggan' => $request->kode_pelanggan,
            'total_biaya' => $request->harga,
            'dibuat_oleh' => $user
        ]);


        foreach( $stuffs as $data){
            $dataDb = Stuff::where('kode_barang', $data->kode_barang)->get();
            $newStok = $dataDb[0]->stok - $data->jumlah;

            Stuff::where('kode_barang', $data->kode_barang)
            ->update([
                'stok' => $newStok
            ]);

            Sales_detail::create([
                'kode_penjualan' => $sales_code,
                'kode_barang' => $data->kode_barang,
                'harga_satuan' => $data->harga_satuan,
                'jumlah' => $data->jumlah
            ]);
        }

        return redirect('/sales')->with('status', 'Penjualan berhasil');
    }
}
