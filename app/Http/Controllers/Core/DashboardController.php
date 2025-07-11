<?php

namespace App\Http\Controllers\Core;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $user = Auth::user();

        return view('admin.dashboard', [
            'jumlahBlog' => 12,
            'jumlahBerita' => 8,
            'dibuatOlehSaya' => 5,
            'jumlahAdmin' => 3,
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
}
