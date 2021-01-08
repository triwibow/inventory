<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CustomerController extends Controller
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
        $prefix = "P";  
        $customer_code = IdGenerator::generate(['table' => 'master_pelanggan','field'=>'kode_pelanggan', 'length' => 4, 'prefix' =>$prefix]);
        $customers = Customer::all();
        return view('customer/customer', ['customers' => $customers,'customer_code'=>$customer_code]);
    }

    
    public function store(Request $request){
        $prefix = "P";  
        $customer_code = IdGenerator::generate(['table' => 'master_pelanggan','field'=>'kode_pelanggan', 'length' => 4, 'prefix' =>$prefix]);
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp_pelanggan' => 'required|digits_between:11,15',
            'alamat_pelanggan'=>'required'
        ]);

        Customer::create([
            'kode_pelanggan' => $customer_code,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_telp_pelanggan' => $request->no_telp_pelanggan,
            'alamat_pelanggan' => $request->alamat_pelanggan
            
        ]);

        return redirect('/customer')->with('status', 'Pelanggan baru berhasil ditambahkan');
    }

    public function edit(Request $request, Customer $customer){
        return view('customer/edit', ['customer' => $customer]);
    }

    public function update(Request $request, Customer $customer){
        $request->validate([
            'nama_pelanggan' => 'required',
            'no_telp_pelanggan' => 'required|digits_between:11,15',
            'alamat_pelanggan'=>'required'
        ]);
        
        Customer::where('kode_pelanggan', $customer->kode_pelanggan)
            ->update([
                'nama_pelanggan' => $request->nama_pelanggan,
                'no_telp_pelanggan' => $request->no_telp_pelanggan,
                'alamat_pelanggan' => $request->alamat_pelanggan
            ]);
        return redirect('customer/'.$customer->kode_pelanggan.'/edit')->with('status', 'Pelanggan berhasil diupdate');

    }

    public function destroy(Customer $customer){
        Customer::destroy($customer->kode_pelanggan);
        return redirect('/customer')->with('status', 'Pelanggan berhasil dihapus');
    }
}
