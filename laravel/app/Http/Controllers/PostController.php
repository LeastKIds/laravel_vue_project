<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function store(Request $request){
        $title = $request['title'];
        $content = $request['content'];
        $user_id = auth()->user()['id'];

        $validator = Validator::make(
            array(
                'title' => $title,
                'content' => $content,
            ),
            array(
                'title' => 'required|string',
                'content' => 'required|string',
            )
        );

        if($validator->fails()) {
            $message = $validator->messages();
            return response($message,422);
        }

        $post = Post::create([
            'title' => $title,
            'content' => $content,
            'user_id' => $user_id
        ]);

        $data = ['success' => 1];
        return response() -> json($data);
    }

    public function show($id) {

        $post = Post::where($id);

        return $post;
    }
}
