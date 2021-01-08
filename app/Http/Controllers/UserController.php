<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
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
        $users = User::all();
        return view('user/user',['users'=>$users]);
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|unique:master_user',
            'password' => 'required'
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'jabatan' => $request->jabatan
        ]);

        return redirect('/user')->with('status', 'User baru berhasil ditambahkan');
    }

    public function edit(Request $request, User $user){
        return view('user/edit', ['user' => $user]);
    }

    public function update(Request $request, User $user){
        $request->validate([
            'username' => 'required|unique:master_user,username,'.$user->username.',username',
        ]);
        
        User::where('username', $user->username)
            ->update([
                'username' => $request->username,
                'jabatan' => $request->jabatan
            ]);
        return redirect('user/'.$request->username.'/edit')->with('status', 'User berhasil diupdate');

    }

    public function destroy(User $user){
        User::destroy($user->username);
        return redirect('/user')->with('status', 'User berhasil dihapus');

    }
}
