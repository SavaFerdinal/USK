<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class APIPeminjamanController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $peminjaman = Peminjaman::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $peminjaman], 200);
        } else {
            $peminjamans = Peminjaman::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $peminjamans], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $peminjaman = Peminjaman::create($request->all());
        return response()->json(['msg' => 'Data created', 'data' => $peminjaman], 201);

        // fillable : user_id id, buku_id id, tanggal_peminjaman date, tanggal_pengembalian date (nullable), kondisi_buku_saat_dipinjam enum[baik, buruk], kondisi_buku_saat_dikembalikan enum[baik, buruk] (nullable), denda float (nullable)
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());
        return response()->json(['msg' => 'Data updated', 'data' => $peminjaman], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
