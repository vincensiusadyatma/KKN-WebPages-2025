<?php


namespace App\Http\Controllers\Core;
use App\Models\Berita;
use App\Models\ContentView;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
  public function index()
{
    $beritas = Berita::latest()->paginate(6);
    $user = Auth::user();

    $beritas->getCollection()->transform(function ($berita) {
        $html = Storage::disk('local')->exists($berita->content_path)
            ? Storage::disk('local')->get($berita->content_path)
            : '';

        $plainText = strip_tags($html);
        $preview = Str::limit($plainText, 200, '...');
        $berita->thumbnail_path = asset('storage/' . $berita->thumbnail_path);
        $berita->preview = $preview;

        return $berita;
    });

    return view('admin.berita_dashboard', [
        'beritas' => $beritas,
        'user' => $user,
    ]);
}


     public function showCreate()
    {
         $user = Auth::user();
        return view('admin.create_berita_dashboard',[
            'user'=>$user
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:100',
        'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
        'editordata' => 'required|string',
    ]);

    $user = Auth::user();

    $slug = Str::slug($request->title);
    $thumbnailFolder = 'berita_thumbnails';
    $contentFolder = 'beritas';
    $txtFilename = $slug . '.txt';
    $thumbFilename = $slug . '.' . $request->file('thumbnail')->getClientOriginalExtension();

    $txtPath = $contentFolder . '/' . $txtFilename;
    $thumbPath = $thumbnailFolder . '/' . $thumbFilename;

    $request->file('thumbnail')->storeAs('public/' . $thumbnailFolder, $thumbFilename);
    Storage::disk('local')->put($txtPath, $request->editordata);

    $berita = Berita::create([
        'title' => $request->title,
        'category' => $request->category,
        'thumbnail_path' => $thumbPath,
        'content_path' => $txtPath,
    ]);

    // Simpan relasi user
    DB::table('berita_creators')->insert([
        'user_id' => $user->id,
        'berita_id' => $berita->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('show-berita')->with('toast', [
        'type' => 'success',
        'message' => 'Berita berhasil disimpan.',
    ]);
}
   public function edit($id)
    {
         $user = Auth::user();
        $berita = Berita::findOrFail($id);
        $berita->content = Storage::disk('local')->get($berita->content_path);
        return view('admin.berita_edit', compact('berita','user'));
    }
     public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'editordata' => 'required|string',
        ]);

        $berita = Berita::findOrFail($id);
        $slug = Str::slug($request->title);
        $txtPath = 'beritas/' . $slug . '.txt';

        Storage::disk('local')->put($txtPath, $request->editordata);

        $thumbPath = $berita->thumbnail_path;
        if ($request->hasFile('thumbnail')) {
            $thumbPath = 'berita_thumbnails/' . $slug . '.' . $request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->storeAs('public/berita_thumbnails', basename($thumbPath));
        }

        $berita->update([
            'title' => $request->title,
            'category' => $request->category,
            'thumbnail_path' => $thumbPath,
            'content_path' => $txtPath,
        ]);

        return redirect()->route('show-berita')->with('toast', [
            'type' => 'success',
            'message' => 'Berita berhasil diperbarui.',
        ]);
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if (Storage::disk('local')->exists($berita->content_path)) {
            Storage::disk('local')->delete($berita->content_path);
        }

        Storage::disk('public')->delete($berita->thumbnail_path);
        $berita->delete();

        return redirect()->route('show-berita')->with('toast', [
            'type' => 'success',
            'message' => 'Berita berhasil dihapus.',
        ]);
    }

    public function show($id)
{
    $berita = Berita::findOrFail($id);
 $user = Auth::user();

    $content = Storage::disk('local')->exists($berita->content_path)
        ? Storage::disk('local')->get($berita->content_path)
        : '<p><i>Konten tidak tersedia.</i></p>';

    return view('admin.berita_detail', compact('berita', 'content','user'));
}

 public function indexBerita()
    {
        $query = Berita::query();

        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        if (request('category')) {
            $query->where('category', request('category'));
        }

        $beritas = $query->latest()->paginate(6);

        $beritas->getCollection()->transform(function ($berita) {
            $html = Storage::disk('local')->exists($berita->content_path)
                ? Storage::disk('local')->get($berita->content_path)
                : '';

            $plainText = strip_tags($html);
            $berita->preview = Str::limit($plainText, 150, '...');
            $berita->thumbnail_path = asset('storage/' . $berita->thumbnail_path);

            return $berita;
        });

        return view('main.berita_main', compact('beritas'));
    }


    public function searchBerita(Request $request)
{
    $searchTerm = $request->input('search');
    $category = $request->input('category');

    $query = Berita::query();

    if (!empty($searchTerm)) {
        $query->where('title', 'like', '%' . $searchTerm . '%');
    }

    if (!empty($category)) {
        $query->where('category', $category);
    }

    $beritas = $query->latest()->paginate(6)->appends($request->only(['search', 'category']));

    $beritas->transform(function ($item) {
        $html = Storage::disk('local')->exists($item->content_path)
            ? Storage::disk('local')->get($item->content_path)
            : '';
        $item->thumbnail_url = asset('storage/' . $item->thumbnail_path);
        $item->preview = Str::limit(strip_tags($html), 200, '...');
        return $item;
    });

    return view('main.berita_main', compact('beritas'));
}


public function detailBerita($id)
{
    $berita = Berita::findOrFail($id);

    // Tambah jumlah views (FIXED: content_type harus 'berita')
  $contentView = ContentView::firstOrCreate(
    ['content_type' => 'berita', 'content_id' => $berita->id],
    ['views' => 0]
);

$contentView->increment('views');

    // Ambil jumlah views
    $views = ContentView::where('content_type', 'berita')
        ->where('content_id', $berita->id)
        ->value('views') ?? 0;

    $user = Auth::user();

    $content = Storage::disk('local')->exists($berita->content_path)
        ? Storage::disk('local')->get($berita->content_path)
        : '<p><i>Konten tidak tersedia.</i></p>';

    return view('main.berita_details', [
        'berita' => $berita,
        'content' => $content,
        'user' => $user,
        'views' => $views
    ]);
}

}
