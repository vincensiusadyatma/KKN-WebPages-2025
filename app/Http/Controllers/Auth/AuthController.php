<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
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
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Coba autentikasi
        if (Auth::attempt([$fieldType => $input, 'password' => $password])) {
            $request->session()->regenerate();

            $user = Auth::user();
         
            $role = $user->roles->pluck('name')->first(); // Ambil role
        

            // Hanya admin yang bisa login ke dashboard
            if ($role === 'admin') {
                notify()->success('You have successfully logged in as admin', 'Success');
                return redirect()->route('show-dashboard-admin');
            }

            // Role bukan admin → logout dan tolak akses
            Auth::logout();
            notify()->error('Hanya admin yang dapat mengakses dashboard.', 'Akses Ditolak');
            return redirect()->route('main')->with('error', 'Akun Anda tidak memiliki akses ke dashboard.');
        }

        // Jika login gagal
        notify()->error('Kredensial salah. Periksa kembali email/username dan password.', 'Login Gagal');
        return redirect()->route('main')->with('error', 'Login gagal. Silakan coba lagi.');
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        notify()->error('Validasi gagal: ' . $e->getMessage(), 'Error Validasi');
        return redirect()->back()->withErrors($e->errors());
    } catch (\Exception $e) {
        notify()->error('Terjadi kesalahan. Coba lagi nanti.', 'Error');
        return redirect()->route('main')->with('error', 'Terjadi kesalahan sistem.');
    }
}

   public function handleLogOut(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
       
        notify()->success('You have successfully logged out.');
        return redirect()->route('main')->with('success', 'Anda telah berhasil logout.');
    }



}
