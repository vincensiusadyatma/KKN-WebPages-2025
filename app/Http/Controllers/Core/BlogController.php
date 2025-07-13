<?php

namespace App\Http\Controllers\Core;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
public function indexBlog()
{
    $blogs = Blog::with('authors')->latest()->paginate(6);

    $blogs->transform(function ($blog) {
        // Ambil isi konten dari file storage
        $html = Storage::disk('local')->exists($blog->content_path)
            ? Storage::disk('local')->get($blog->content_path)
            : '';

        $plainText = strip_tags($html);
        $preview = Str::limit($plainText, 200, '...');

        $blog->thumbnail_path = asset('storage/' . $blog->thumbnail_path);
        $blog->preview = $preview;

        return $blog;
    });

    return view('main.blog_main', compact('blogs'));
}



 public function showBlogDetail($id)
{
    $blog = Blog::findOrFail($id);

    // Ambil isi file HTML dari storage/app/blogs/xxx.txt
    $content = Storage::disk('local')->exists($blog->content_path)
        ? Storage::disk('local')->get($blog->content_path)
        : '<p><i>Konten tidak tersedia.</i></p>';

    // Path gambar thumbnail
    $blog->thumbnail_url = asset('storage/' . $blog->thumbnail_path);
  
    return view('main.blog_details_main', compact('blog', 'content'));
}

     // Fitur pencarian blog berdasarkan judul
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string|max:100',
        ]);

        $searchTerm = $request->input('search');

        $blogs = Blog::where('title', 'like', '%' . $searchTerm . '%')
                     ->latest()
                     ->paginate(6)
                     ->appends(['search' => $searchTerm]); // agar pagination tetap bawa keyword

        return view('main.blog.index', compact('blogs'));
    }
    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'editordata' => 'required|string',
        ]);

        $user = Auth::user();

        $slug = Str::slug($request->title);
        $thumbnailFolder = 'blog_thumbnails';
        $contentFolder = 'blogs';
        $txtFilename = $slug . '.txt';
        $thumbFilename = $slug . '.' . $request->file('thumbnail')->getClientOriginalExtension();

        $txtPath = $contentFolder . '/' . $txtFilename;
        $thumbPath = $thumbnailFolder . '/' . $thumbFilename;

        // Simpan thumbnail ke storage/public
        $request->file('thumbnail')->storeAs('public/' . $thumbnailFolder, $thumbFilename);

        // Simpan konten HTML ke storage/app/blogs/slug.txt
        Storage::disk('local')->put($txtPath, $request->editordata);

        // Simpan ke database
        $blog = Blog::create([
            'title' => $request->title,
            'thumbnail_path' => $thumbPath,
            'content_path' => $txtPath,
        ]);

        // Simpan relasi blog dan user
        DB::table('blog_creators')->insert([
            'user_id' => $user->id,
            'blog_id' => $blog->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('show-blog')->with('toast', [
            'type' => 'success',
            'message' => 'Blog berhasil disimpan.',
        ]);
    }

public function showBlog()
{
    $user = Auth::user();
    $blogs = Blog::latest()->get();

    $blogs->transform(function ($blog) {
        // Ambil isi file HTML mentah
        $html = Storage::disk('local')->exists($blog->content_path)
            ? Storage::disk('local')->get($blog->content_path)
            : '';

        // Hapus semua tag HTML, ambil teks bersih
        $plainText = strip_tags($html);

        // Ambil sekitar 200 karakter (2 baris pendek)
        $preview = \Illuminate\Support\Str::limit($plainText, 200, '...');

        // Simpan URL thumbnail
        $blog->thumbnail_path = asset('storage/' . $blog->thumbnail_path);
        $blog->preview = $preview;

        return $blog;
    });

    return view('admin.blog_dashboard', [
        'user' => $user,
        'blogs' => $blogs,
    ]);
}

public function showDetail($id)
{
    $blog = Blog::findOrFail($id);
    $user = Auth::user();

    $content = Storage::disk('local')->exists($blog->content_path)
        ? Storage::disk('local')->get($blog->content_path)
        : '';

    return view('admin.blog_detail', compact('blog', 'user', 'content'));
}

public function edit($id)
{
    $user = Auth::user();
    $blog = Blog::findOrFail($id);

    // Ambil konten dari file storage
    $html = Storage::disk('local')->exists($blog->content_path)
        ? Storage::disk('local')->get($blog->content_path)
        : '';

    $blog->content = $html;

    return view('admin.blog_edit', [
        'user' => $user,
        'blog' => $blog,
    ]);
}


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        'editordata' => 'required|string',
    ]);

    $blog = Blog::findOrFail($id);
    $slug = Str::slug($request->title);
    $txtPath = 'blogs/' . $slug . '.txt';

    // Update konten file
    Storage::disk('local')->put($txtPath, $request->editordata);

    $thumbPath = $blog->thumbnail_path;
    if ($request->hasFile('thumbnail')) {
        $thumbFilename = $slug . '.' . $request->file('thumbnail')->getClientOriginalExtension();
        $thumbPath = 'blog_thumbnails/' . $thumbFilename;
        $request->file('thumbnail')->storeAs('public/blog_thumbnails', $thumbFilename);
    }

    $blog->update([
        'title' => $request->title,
        'thumbnail_path' => $thumbPath,
        'content_path' => $txtPath,
    ]);

    return redirect()->route('show-blog')->with('toast', [
        'type' => 'success',
        'message' => 'Blog berhasil diperbarui.',
    ]);
}

public function destroy($id)
{
    $blog = Blog::findOrFail($id);

    // Hapus file
    if (Storage::disk('local')->exists($blog->content_path)) {
        Storage::disk('local')->delete($blog->content_path);
    }
    Storage::disk('public')->delete($blog->thumbnail_path);

    // Hapus relasi dan blog
    DB::table('blog_creators')->where('blog_id', $blog->id)->delete();
    $blog->delete();

    return redirect()->route('show-blog')->with('toast', [
        'type' => 'success',
        'message' => 'Blog berhasil dihapus.',
    ]);
}



}
