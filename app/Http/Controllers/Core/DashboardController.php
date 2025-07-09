<?php

namespace App\Http\Controllers\Core;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function showCreateBlog(){
        $user = Auth::user();
        // dd("s");
        return view('admin.create_blog_dashboard',[
            'user'=> $user,
        ]);
    }

}
