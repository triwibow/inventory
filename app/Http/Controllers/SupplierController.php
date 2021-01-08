<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
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
        $prefix = "S";  
        $supplier_code = IdGenerator::generate(['table' => 'master_supplier','field'=>'kode_supplier', 'length' => 4, 'prefix' =>$prefix]);
        $suppliers = Supplier::all();
        return view('supplier/supplier',['suppliers' => $suppliers, 'supplier_code' => $supplier_code]);
    }

    public function store(Request $request){
        $prefix = "S";  
        $supplier_code = IdGenerator::generate(['table' => 'master_supplier','field'=>'kode_supplier', 'length' => 4, 'prefix' =>$prefix]);
        $request->validate([
            'nama_supplier' => 'required',
            'no_telp_supplier' => 'required|digits_between:11,15',
            'alamat_supplier'=>'required'
        ]);

        Supplier::create([
            'kode_supplier' => $supplier_code,
            'nama_supplier' => $request->nama_supplier,
            'no_telp_supplier' => $request->no_telp_supplier,
            'alamat_supplier' => $request->alamat_supplier
            
        ]);

        return redirect('/supplier')->with('status', 'Supplier baru berhasil ditambahkan');
    }

    public function edit(Request $request, Supplier $supplier){
        return view('supplier/edit', ['supplier' => $supplier]);
    }

    public function update(Request $request, Supplier $supplier){
        $request->validate([
            'nama_supplier' => 'required',
            'no_telp_supplier' => 'required|digits_between:11,15',
            'alamat_supplier'=>'required'
        ]);
        
        Supplier::where('kode_supplier', $supplier->kode_supplier)
            ->update([
                'nama_supplier' => $request->nama_supplier,
                'no_telp_supplier' => $request->no_telp_supplier,
                'alamat_supplier' => $request->alamat_supplier
            ]);
        return redirect('supplier/'.$supplier->kode_supplier.'/edit')->with('status', 'Supplier berhasil diupdate');

    }

    public function destroy(Supplier $supplier){
        Supplier::destroy($supplier->kode_supplier);
        return redirect('/supplier')->with('status', 'Supplier berhasil dihapus');
    }
}
