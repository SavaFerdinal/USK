<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class APIPemberitahuanController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $pemberitahuan = Pemberitahuan::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $pemberitahuan], 200);
        } else {
            $pemberitahuans = Pemberitahuan::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $pemberitahuans], 200);
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
        $pemberitahuan = Pemberitahuan::create($request->all());
        return response()->json(['msg' => 'Data created', 'data' => $pemberitahuan], 201);

        // fillable : isi texxt, level_user str (nullable), status enum[terkirim, dibaca] (nullable)
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
        $pemberitahuan = Pemberitahuan::findOrFail($id);
        $pemberitahuan->update($request->all());
        return response()->json(['msg' => 'Data updated', 'data' => $pemberitahuan], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemberitahuan = Pemberitahuan::findOrFail($id);
        $pemberitahuan->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
