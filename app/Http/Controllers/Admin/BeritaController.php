<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function indexBerita() {
        $beritas = Berita::all();

        return view('admin.berita', compact('beritas'));
    }

    public function storeBerita(Request $request) {
        $berita = Berita::all();

        $berita = Berita::create([
            'isi' => $request->isi,
            'status' => 'aktif',
        ]);

        if ($berita) {
            return redirect()
                ->back()
                ->with("status", "success")
                ->with("message", "Berhasil Mengposting Berita");
        }
        return redirect()->back()
            ->with("status", "danger")
            ->with("message", "Gagal Mengposting Berita");
    }

    public function updateBerita(Request $request, $id) {
        $berita = Berita::findOrFail($id);
        $berita->update([
            'isi' => $request->isi,
        ]);
        return redirect()->back();
    }

    public function updateStatusBerita($id, Request $request){
        $berita = Berita::where('id', $id)->first();

        if ($berita != null) {
            if ($request->status == 'nonaktif') {
                $berita->update([
                    'status' => 'aktif'
                ]);
            }
            if ($request->status == 'aktif') {
                $berita->update([
                    'status' => 'nonaktif'
                ]);
            }

            return redirect()
                ->back()
                ->with("status", "success")
                ->with("message", "Berhasil Merubah Status");
        }
        return redirect()->back()
            ->with("status", "danger")
            ->with("message", "Gagal Merubah Status");
    }

    public function deleteBerita($id){
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->back();
    }
}
