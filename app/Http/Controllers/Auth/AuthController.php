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
                return redirect()->route('show-dashboard');
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

    // Mulai transaksi database
    DB::beginTransaction();

    try {
        // Buat user baru
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'active',
        ]);

        // Assign default role (misal role_id 2 = user biasa)
        DB::table('role_ownerships')->insert([
            'user_id' => $user->id,
            'role_id' => 2,
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Commit transaksi
        DB::commit();

        // Notifikasi sukses
        notify()->success('Registrasi berhasil. Selamat datang!', 'Sukses');

        // Redirect ke halaman utama
        return redirect()->route('main');
    } catch (\Throwable $th) {
        // Rollback jika terjadi error
        DB::rollBack();

        // Simpan log error
        Log::error('Registration Error: ' . $th->getMessage());

        // Redirect kembali ke form register dengan pesan error
        return redirect()->route('show-register')->withErrors(['error' => 'Registrasi gagal. Silakan coba lagi.']);
    }
}


}
