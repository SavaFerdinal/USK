<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIPesanController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $pesan = Pesan::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $pesan], 200);
        } else {
            $pesan = Pesan::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $pesan], 200);
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
        $date = date("Y-m-d");

        $pesan = Pesan::create([
            'penerima_id' => $request->penerima_id,
            'pengirim_id' => Auth::user()->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'status' => $request->status,
            'tanggal_kirim' => $date
        ]);
        return response()->json(['msg' => 'Data created', 'data' => $pesan], 201);

        // fillable : penerima_id id, pengirim_id id, judul str, isi text, status enum[terkirim, dibaca] (nullable), tanggal_kirim date
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
        $pesan = Pesan::findOrFail($id);
        $pesan->update($request->all());
        return response()->json(['msg' => 'Data updated', 'data' => $pesan], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
