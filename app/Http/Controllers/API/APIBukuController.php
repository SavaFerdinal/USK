<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class APIBukuController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $buku = Buku::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $buku], 200);
        } else {
            $buku = Buku::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $buku], 200);
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
        // fillable : judul str, kategori_id id, penerbit_id id, pengarang str, tahun_terbit char, isbn int (nullable), j_buku_baik int, j_buku_buruk int, photo text (nullable)

        $rules = [
            'judul' => 'required',
            'kategori_id' => 'required',
            'penerbit_id' => 'required',
            'tahun_terbit' => 'required',
            'pengarang' => 'required',
            'j_buku_baik' => 'required',
            'j_buku_buruk' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(['msg' => 'Failed created', 'error' => $errors], 400);
        }

        try {
            if ($request->photo) {
                $imageName = time() . '.' . $request->photo->extension();

                $request->photo->move(public_path('img'), $imageName);
                try {
                    $buku = Buku::create([
                        'judul' => $request->judul,
                        'kategori_id' => $request->kategori_id,
                        'penerbit_id' => $request->penerbit_id,
                        'tahun_terbit' => $request->tahun_terbit,
                        'isbn' => $request->isbn,
                        'pengarang' => $request->pengarang,
                        'j_buku_baik' => $request->j_buku_baik,
                        'j_buku_buruk' => $request->j_buku_buruk,
                        'photo' => "/img/" . $imageName
                    ]);

                    return response()->json(['msg' => 'Data created', 'data' => $buku], 201);
                } catch (Exception $error) {
                    return response()->json(['msg' => 'Failed create data', 'error' => $error], 400);
                }
            }
            $buku = Buku::create($request->all());

            if ($buku) {
                return response()->json(['msg' => 'Data created', 'data' => $buku], 201);
            }
        } catch (Exception $error) {
            return response()->json(['msg' => 'Failed create data', 'error' => $error], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            if ($request->file('photo') != null) {
                try {
                    $imageName = time() . '.' . $request->file('photo')->extension();
                    $request->file('photo')->move(public_path('img'), $imageName);
                    $buku = Buku::find($id);
                    $buku->update($request->all());

                    $buku2 = Buku::find($id);
                    $buku2->update([
                        "photo" => "/img/" . $imageName
                    ]);

                    if ($buku && $buku2) {
                        return response()->json(['msg' => 'Data updated', 'data' => $buku2], 200);
                    }
                } catch (Exception $error) {
                    return response()->json(['msg' => 'Failed update data', 'error' => $error], 400);
                }
            }

            $buku = Buku::find($id);
            $buku->update($request->all());

            return response()->json(['msg' => 'Data updated', 'data' => $buku], 200);
        } catch (Exception $error) {
            return response()->json(['msg' => 'Failed update data', 'error' => $error], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }
}
