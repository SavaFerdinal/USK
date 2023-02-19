<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class APIKategoriController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $kategori = Kategori::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $kategori], 200);
        } else {
            $kategoris = Kategori::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $kategoris], 200);
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
        $kategori = Kategori::create($request->all());
        return response()->json(['msg' => 'Data created', 'data' => $kategori], 201);

        // fillable : kode str, nama str
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->all());
        return response()->json(['msg' => 'Data updated', 'data' => $kategori], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
