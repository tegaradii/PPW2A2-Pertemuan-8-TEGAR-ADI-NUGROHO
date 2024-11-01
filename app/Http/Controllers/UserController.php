<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login')
                ->withErrors(['email' => 'Silahkan login terlebih dahulu untuk mengakses dashboard'])
                ->onlyInput('email');
        }
        $users = User::get();
        return view('users')->with('userss', $users);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $file = public_path().'storage/'.$user->photo;
        if (!$user) {
            return redirect('users')->with('error', 'User tidak ditemukan');
        }
        try {
            dd($file);
            if (File::exists($file)) {
                File::delete($file);
                $user->delete();
            }
            // dd($user);

        } catch (\Throwable $th) {
            return redirect('users')->with('error', 'Gagal menghapus data');
        }
        return redirect('users')->with('success', 'Data berhasil dihapus');
    }
}
