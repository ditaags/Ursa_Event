namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent; // Pastikan kamu punya model untuk konten beranda

class HomeController extends Controller
{
    public function edit()
    {
        // Ambil data pertama (asumsi hanya ada 1 data konten beranda)
        $content = HomeContent::first(); 
        return view('admin.edit_beranda', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $content = HomeContent::first();
        $content->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Beranda berhasil diperbarui!');
    }
}