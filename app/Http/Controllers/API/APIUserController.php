<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class APIUserController extends Controller
{
    /**
     * Display a data / listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($id = null)
    {
        if (isset($id)) {
            $user = User::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $user], 200);
        } else {
            $user = User::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $user], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_admin(Request $request)
    {
        $date = date("Y-m-d");
        $generate_code = "";

        if ($request->role === 'admin') {
            $generate_code = 'ADM' . substr(md5(random_int(1, 8605)), 0, 17);
        } else {
            $generate_code = 'USR' . substr(md5(random_int(1, 8605)), 0, 17);
        }

        // Stored data validation
        $rules = [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ],
                400
            );
        }

        try {
            if ($request->photo !== null) {
                $imageName = time() . '.' . $request->photo->extension();

                $request->photo->move(public_path('img'), $imageName);
                try {

                    $admin = User::create([
                        'kode' => $generate_code,
                        'nis' => $request->nis,
                        'fullname' => $request->fullname,
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'kelas' => $request->kelas,
                        'alamat' => $request->alamat,
                        'photo' => "/img/" . $imageName,
                        'verif' => "verified",
                        'role' => $request->role,
                        'join_date' => $date,
                        'terakhir_login' => null,
                    ]);
                    return response()->json(['msg' => 'Data created', 'data' => $admin], 201);
                } catch (Exception $error) {
                    return response()->json(['msg' => 'Data created', 'data' => $error], 201);
                }
            }
            $admin = User::create($request->all());

            if ($admin) {
                return response()->json(['msg' => 'Data created', 'data' => $admin], 201);
            }
        } catch (Exception $error) {
            return response()->json(['msg' => 'Data created', 'data' => $error], 201);
        }
    }
    public function store_user(Request $request)
    {
        $date = date("Y-m-d");

        $generate_code = 'USR' . substr(md5(random_int(1, 8605)), 0, 17);

        // Stored data validation
        $rules = [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ],
                400
            );
        }

        try {
            if ($request->photo != null) {
                $imageName = time() . '.' . $request->photo->extension();

                $request->photo->move(public_path('img'), $imageName);
                try {
                    $user = User::create([
                        'kode' => $generate_code,
                        'nis' => $request->nis,
                        'fullname' => $request->fullname,
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'kelas' => $request->kelas,
                        'alamat' => $request->alamat,
                        'photo' => "/img/" . $imageName,
                        'verif' => "unverified",
                        'role' => 'user',
                        'join_date' => $date,
                        'terakhir_login' => null,
                    ]);
                    return response()->json(['msg' => 'Data created', 'data' => $user], 201);
                } catch (Exception $error) {
                    return response()->json(['msg' => 'Failed create data', 'error' => $error], 400);
                }
            }
            $user = User::create($request->all());

            if ($user) {
                return response()->json(['msg' => 'Data created', 'data' => $user], 201);
            }
        } catch (Exception $error) {
            return response()->json(['msg' => 'Failed create data', 'error' => $error], 400);
        }
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
            if ($request->photo !== null) {
                try {
                    $imageName = time() . '.' . $request->photo->extension();

                    $request->photo->move(public_path('img'), $imageName);

                    $user = User::find($id);
                    $user->update($request->all());

                    $user2 = User::find($id);
                    $user2->update([
                        "photo" => "/img/" . $imageName
                    ]);

                    if ($user && $user2) {
                        return response()->json(['msg' => 'Data updated', 'data' => $user2], 200);
                    }
                } catch (Exception $error) {
                    return response()->json(['msg' => 'Failed update data', 'error' => $error], 200);
                }
            }
            $user = User::find($id);
            $user->update($request->all());

            return response()->json(['msg' => 'Data updated', 'data' => $user], 200);
        } catch (Exception $error) {
            return response()->json(['msg' => 'Failed update data', 'error' => $error], 200);
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
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }

    // AUTHENTICATION
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('username', $request['username'])->firstOrFail();

        // $token = auth()->user()->createToken('secret')->plainTextToken;

        return response()
            ->json(['message' => 'Hi ' . $user->fullname, 'access_token' => auth()->user()->createToken('secret')->plainTextToken, 'token_type' => 'Bearer']);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logout '
        ]);
    }
}
