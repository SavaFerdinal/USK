<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class APIPenerbitController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $penerbit = Penerbit::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $penerbit], 200);
        } else {
            $penerbits = Penerbit::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $penerbits], 200);
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
        $penerbit = Penerbit::create(
            $request->all()
        );
        return response()->json(['msg' => 'Data created', 'data' => $penerbit], 201);

        // fillable : kode str, nama str, verif_penerbit str (nullable)
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());
        return response()->json(['msg' => 'Data updated', 'data' => $penerbit], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penerbit  $penerbit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penerbit $penerbit, $id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
