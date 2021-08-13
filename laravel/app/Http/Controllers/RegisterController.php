<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;


class RegisterController extends Controller
{
    //

    public function register(Request $request) {

        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];

//        return response() -> json(['name' => $name, 'email' => $email, 'password' => $password]);

        $validator = Validator::make(
            array(
                'name' => $name,
                'email' => $email,
                'password' => $password
            ),
            array(
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', Rules\Password::defaults()],
            )
        );
//        if ($validator->fails()) {
//            return response()->json(['errors'=>$validator->errors()],400);
//        }


        if($validator->fails()) {
            $message = $validator->messages();
            return response($message,422);
        }
//
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $data = ['success' => 1];
        return response() -> json($data);
    }

    public function loginCheck() {
        $user = auth() -> user();
        if($user !=null)
            $data=['login' => 1, 'user' => $user];
        else
            $data = ['login' => 0, 'user' => null];
        return response()-> json($data);
    }

    public function login(Request $request) {

        if(!auth() -> attempt($request -> only('email','password'))) {
            $result = ['error' => '이메일 또는 비밀번호가 맞지 않습니다.', 'success' => 0, 'user' => null];
            return response() -> json($result);
        }

        $request -> session() -> regenerate();

        $result = ['user' => auth()->user(), 'success' => 1,];

        return response() -> json($result);
    }

    public function logout() {
        auth() -> logout();

        $result = ['user' => auth() -> user(), 'success' => 1];

        return response() -> json($result);
    }

}
