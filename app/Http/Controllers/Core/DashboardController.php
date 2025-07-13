<?php

namespace App\Http\Controllers\Core;

use App\Models\Blog;
use App\Models\User;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
public function showDashboard()
{
    $user = Auth::user();

    $jumlahBlog = Blog::count();
    $jumlahBerita = Berita::count();
    $dibuatOlehSaya = $user->blogs->count();

    $jumlahAdmin = User::whereHas('roles', function ($query) {
        $query->where('name', 'admin');
    })->count();

    return view('admin.dashboard', [
        'jumlahBlog' => $jumlahBlog,
        'jumlahBerita' => $jumlahBerita,
        'dibuatOlehSaya' => $dibuatOlehSaya,
        'jumlahAdmin' => $jumlahAdmin,
        'user' => $user,
        'blogs' => Blog::latest()->take(10)->get(),
        'beritas' => Berita::latest()->take(10)->get(),
    ]);
}


    public function showBlog()
    {
        $user = Auth::user();

        return view('admin.blog_dashboard', [
            'user' => $user,
        ]);
    }

    public function showBerita()
    {
        $user = Auth::user();

        return view('admin.berita_dashboard', [
            'user' => $user,
        ]);
    }

    public function showAdminManagement()
    {
        $user = Auth::user();

        $list_users = User::where('id', '!=', $user->id)->get();

        return view('admin.user_admin_dashboard', [
            'user' => $user,
            'list_users' => $list_users
        ]);
    }

    public function showCreateBlog()
    {
        $user = Auth::user();

        return view('admin.create_blog_dashboard', [
            'user' => $user,
        ]);
    }

    public function showAdminDetails($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user_admin_detail_dashboard', [
            'user' => $user,
        ]);
    }

    public function changeStatus(Request $request, User $user)
    {
        $currentUser = Auth::user();

        // Cek apakah user yang login adalah super admin
        if ($currentUser->roles->first()?->name !== 'super admin') {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki akses untuk mengubah status.',
            ]);
        }

        $status = $request->input('status');

        if (!in_array($status, ['active', 'decline'])) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Status tidak valid.',
            ]);
        }

        $user->status = $status;
        $user->save();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'message' => 'Status berhasil diubah menjadi "' . $status . '".',
        ]);
    }

    public function deleteAdmin($id)
{
    try {
        $user = User::findOrFail($id);
$userAuth = Auth::user();
        // Cegah pengguna menghapus dirinya sendiri (opsional)
        if ($userAuth->id == $user->id) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Anda tidak bisa menghapus akun Anda sendiri.',
            ]);
        }

        DB::transaction(function () use ($user) {
            // Hapus relasi role
            $user->roles()->detach();

            // Hapus user
            $user->delete();
        });

        return redirect()->route('show-admin-management')->with('toast', [
            'type' => 'success',
            'message' => 'Akun berhasil dihapus.',
        ]);

    } catch (\Exception $e) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'Gagal menghapus akun. Silakan coba lagi.',
        ]);
    }
}

public function settings()
{
    $user = Auth::user();
    return view('admin.settings',[
        'user' => $user
    ]);
}

public function updatePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('toast', ['type' => 'error', 'message' => 'Password lama salah.']);
    }

    DB::table('users')
        ->where('id', $user->id)
        ->update(['password' => Hash::make($request->new_password)]);

    return back()->with('toast', ['type' => 'success', 'message' => 'Password berhasil diubah.']);
}

public function updateSettings(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'new_password' => 'nullable|string|min:6',
    ]);

    $data = [
        'username' => $request->username,
        'email' => $request->email,
    ];

    if ($request->filled('new_password')) {
        $data['password'] = Hash::make($request->new_password);
    }

    DB::table('users')->where('id', $user->id)->update($data);

    return back()->with('toast', ['type' => 'success', 'message' => 'Data berhasil diperbarui.']);
}

}
