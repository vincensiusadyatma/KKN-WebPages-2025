<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
      public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

public function handleLogin(Request $request)
{
    try {
        $input = $request->input('email'); 
        $password = $request->input('password');

        // Tentukan apakah input adalah email atau username
        $fieldType = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Validasi input
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Ambil user
        $user = \App\Models\User::where($fieldType, $input)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return redirect()->route('main')->with('toast', [
                'type' => 'error',
                'message' => 'Akun tidak ditemukan.',
            ]);
        }

        // Cek status user
        if ($user->status !== 'active') {
            return redirect()->route('main')->with('toast', [
                'type' => 'error',
                'message' => 'Akun Anda belum aktif atau sedang ditolak.',
            ]);
        }

        // Coba autentikasi
        if (Auth::attempt([$fieldType => $input, 'password' => $password])) {
            $request->session()->regenerate();

            $role = $user->roles->pluck('name')->first();

            // Hanya admin atau super admin yang bisa login
            if ($role === 'admin' || $role === 'super admin') {
                return redirect()->route('show-dashboard')->with('toast', [
                    'type' => 'success',
                    'message' => 'Anda berhasil login sebagai admin.',
                ]);
            }

            // Jika bukan admin, logout
            Auth::logout();
            return redirect()->route('main')->with('toast', [
                'type' => 'error',
                'message' => 'Hanya admin yang dapat mengakses dashboard.',
            ]);
        }

        // Jika password salah
        return redirect()->route('main')->with('toast', [
            'type' => 'error',
            'message' => 'Password salah. Silakan coba lagi.',
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->errors())
            ->with('toast', [
                'type' => 'error',
                'message' => 'Validasi gagal: ' . $e->getMessage(),
            ]);
    } catch (\Exception $e) {
        return redirect()->route('main')->with('toast', [
            'type' => 'error',
            'message' => 'Terjadi kesalahan sistem.',
        ]);
    }
}

 public function handleLogOut(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('main')->with('toast', [
        'type' => 'success',
        'message' => 'Anda telah berhasil logout.',
    ]);
}


public function handleRegister(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string|max:50|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|string|max:15',
        'birthdate' => 'required|date',
        'password' => 'required|string|min:8|confirmed',
    ]);

    DB::beginTransaction();

    try {
        // Buat user dengan status pending
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'birthdate' => $request->birthdate,
            'password' => bcrypt($request->password),
            'status' => 'pending',
        ]);

        // Assign role default
        DB::table('role_ownerships')->insert([
            'user_id' => $user->id,
            'role_id' => 2, // misalnya 'user biasa'
        ]);

        DB::commit();

        // Tidak langsung login — beri notifikasi saja
        return redirect()->route('main')->with('toast', [
            'type' => 'success',
            'message' => 'Registrasi berhasil! Tunggu persetujuan admin sebelum bisa login.',
        ]);
    } catch (\Throwable $th) {
        DB::rollBack();
        Log::error('Registration Error: ' . $th->getMessage());

        return redirect()->route('show-register')
            ->withErrors(['error' => 'Registrasi gagal. Silakan coba lagi.'])
            ->with('toast', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat registrasi.',
            ]);
    }
}


}
