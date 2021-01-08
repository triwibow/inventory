<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sales;
use App\Sales_detail;
use App\Purchase;
use App\Purchase_detail;
use App\Stuff;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $stuffs = Stuff::all();

        return view('report/report', ['stuffs' => $stuffs]);
    }

    public function filter(Request $request){

        $stuff = Stuff::where('kode_barang', $request->kode_barang)->get();

        $purchases = Purchase::with(['detailPembelian' => function($query)use($request){
            $query->where('detail_pembelian.kode_barang',$request->kode_barang);
        }])
        ->whereBetween('tanggal_pembelian',[$request->tanggal_awal, $request->tanggal_akhir])
        ->get();

        $sales = Sales::with(['detailPenjualan' => function($query)use($request){
            $query->where('detail_penjualan.kode_barang',$request->kode_barang);
        }])
        ->whereBetween('tanggal_penjualan',[$request->tanggal_awal, $request->tanggal_akhir])
        ->get();

        
        
        $request->session()->put('purchases', $purchases);
        $request->session()->put('sales', $sales);
        $request->session()->put('stuff', $stuff);
        $request->session()->put('awal', $request->tanggal_awal);
        $request->session()->put('akhir', $request->tanggal_akhir);

        return redirect('/filter');
    }

    public function show(){
        $purchases = session()->get('purchases');
        $sales = session()->get('sales');
        $stuff = session()->get('stuff');
        $awal = session()->get('awal');
        $akhir = session()->get('akhir');

        return view('report/show', ['purchases' => $purchases, 'sales'=>$sales, 'stuff'=>$stuff, 'awal'=>$awal,'akhir'=>$akhir]);
    }
}
