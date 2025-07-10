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
    // Validasi input form
    $credentials = $request->validate([
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'email.required' => 'Email tidak boleh kosong.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'password.required' => 'Password tidak boleh kosong.',
        'password.min' => 'Password harus memiliki minimal 8 karakter.',
        'password.confirmed' => 'Password konfirmasi tidak sesuai.',
    ]);

    DB::beginTransaction();

    try {
        // Buat user baru
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'active',
        ]);

        // Assign default role
        DB::table('role_ownerships')->insert([
            'user_id' => $user->id,
            'role_id' => 2, // misalnya role_id 2 adalah 'user'
        ]);

        // Login otomatis
        Auth::login($user);

        DB::commit();

        // Beri toast sukses dan redirect
        return redirect()->route('main')->with('toast', [
            'type' => 'success',
            'message' => 'Registrasi berhasil. Selamat datang!',
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
