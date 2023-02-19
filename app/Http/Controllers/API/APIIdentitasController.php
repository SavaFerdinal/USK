<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Exception;
use Illuminate\Http\Request;

class APIIdentitasController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $identitas = Identitas::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $identitas], 200);
        } else {
            $identitass = Identitas::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $identitass], 200);
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
        $identitas = Identitas::create($request->all());
        return response()->json(['msg' => 'Data created', 'data' => $identitas], 201);

        // fillable : nama_app str, photo text (nullable), alamat_app text, email_app str, nomor_hp char
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
        try {
            if ($request->photo != null) {
                try {
                    $imageName = time() . '.' . $request->photo->extension();

                    $request->photo->move(public_path('img'), $imageName);
                    $identitas = Identitas::find($id);
                    $identitas->update($request->all());

                    $identitas2 = Identitas::find($id);
                    $identitas2->update([
                        "photo" => "/img/" . $imageName
                    ]);

                    if ($identitas && $identitas2) {
                        return response()->json(['msg' => 'Data updated', 'data' => $identitas2], 200);
                    }
                } catch (Exception $error) {
                    return response()->json(['msg' => 'Failed update data', 'error' => $error], 400);
                }
            }
            $identitas = Identitas::find($id);
            $identitas->update($request->all());

            return response()->json(['msg' => 'Data updated', 'data' => $identitas], 200);
        } catch (Exception $error) {
            return response()->json(['msg' => 'Failed update data', 'error' => $error], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $identitas = Identitas::findOrFail($id);
        $identitas->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
