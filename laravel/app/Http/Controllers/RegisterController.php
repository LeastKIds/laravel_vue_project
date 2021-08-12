<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //

    public function register(Request $request) {

        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];

        return $request;
    }

    public function loginCheck() {
        $user = auth() -> user();
        if($user !=null)
            $data=['login' => 1, 'id' => $user['id']];
        else
            $data = ['login' => 0, 'id' => null];
        return response()-> json($data);
    }
}
