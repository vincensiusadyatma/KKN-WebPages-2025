<?php

namespace App\Http\Controllers\Core;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    public function showDashboard(){
        $user = Auth::user();

        return view('admin.dashboard', [
        'jumlahBlog' => 12,
        'jumlahBerita' => 8,
        'dibuatOlehSaya' => 5,
        'jumlahAdmin' => 3,
    ]);

    }

    public function showBlog(){
          $user = Auth::user();

          return view('admin.blog_dashboard',[
            'user' => $user,
          ]);
    }

    public function showBerita(){
        $user = Auth::user();
        return view('admin.berita_dashboard',[
            'user' => $user,
          ]);
    }

  public function showAdminManagement(){
    $user = Auth::user();

    // Ambil semua user KECUALI user yang sedang login
    $list_users = User::where('id', '!=', $user->id)->get();

    return view('admin.user_admin_dashboard', [
        'user' => $user,
        'list_users' => $list_users
    ]);
 }


    public function showCreateBlog(){
        $user = Auth::user();
        // dd("s");
        return view('admin.create_blog_dashboard',[
            'user'=> $user,
        ]);
    }

   public function showAdminDetails($id)
{
    $user = User::findOrFail($id); // cari berdasarkan id, 404 jika tidak ditemukan

    return view('admin.user_admin_detail_dashboard', [
        'user' => $user,
    ]);
}

public function changeStatus(Request $request, User $user)
{
    $currentUser = Auth::user();

    // Cek apakah user login adalah super admin (secara manual)
    if ($currentUser->roles->first()?->name !== 'super admin') {
        abort(403, 'Anda tidak memiliki akses untuk mengubah status.');
    }

    $status = $request->input('status');

    if (!in_array($status, ['active', 'decline'])) {
        return redirect()->back()->with('error', 'Status tidak valid.');
    }

    $user->status = $status;
    $user->save();

    return redirect()->back()->with('success', 'Status berhasil diubah menjadi ' . $status);
}


}
