<?php

namespace App\Http\Controllers\API;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Config;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->mssv;
        $user->mssv = $request->mssv;
        $user->email = $request->email;
        $user->birthday = Carbon::parse($request->birthday);
        $user->phone = $request->phone;
        $user->password = bcrypt($request->mssv);
        $user->change_password = 0;
        $user->save();


        return response()->json(['data' => true], 201);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $data = [
                'token' => Auth::user()->createToken(Config::get('app.name'))->accessToken,
            ];
            return response()->json(['data' => $data], 200);

        }

        return response()->json(['data' => false], 403);
    }
}
