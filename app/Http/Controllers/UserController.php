<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return response()->json([
            'status' => 'success',
            'users' => $users->toArray()
        ], 200);
    }

    public function show(Request $request, $id) {
        $user = User::find($id);

        return response()->json([
            'status' => 'success',
            'user' => $user->toArray()
        ], 200);
    }

    public function update(Request $request) {
        $user = Auth::user();

        $v = Validator::make($request->all(), [
            'username' => 'unique:users,username,' . $request->id,
            'email' => 'unique:users,email,' . $request->id
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user->fill([
            'name' => $request->name,
            'surname' => $request->surname,
            'username' => $request->username,
            'email' => $request->email,
            'gender' => $request->gender
        ]);

        if ($request->password) {
            $user->fill([
                'password' => bcrypt($request->password)
            ]);
        }

        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function delete (Request $request) {
        error_log($request);
        $user = Auth::user();
        $user->delete();

        return response()->json(['status' => 'success'], 200);
    }
}
