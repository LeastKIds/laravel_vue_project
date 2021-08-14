<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index() {
        $posts = Post::latest();
        return $posts;
    }

    public function store(Request $request){
        $title = $request['title'];
        $content = $request['content'];
        $imgFile = $request['imgFile'];

        $user_id = auth()->user()['id'];

        $validator = Validator::make(
            array(
                'title' => $title,
                'content' => $content,
                'imgFile' => $imgFile
            ),
            array(
                'title' => 'required|string',
                'content' => 'required|string',
                'imageFile' => 'image | max:2000',
            )
        );

        if($validator->fails()) {
            $message = $validator->messages();
            return response($message,422);
        }

        $post = Post::create([
            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
            'img' = $this -> uploadPostImage($request)
        ]);

//        $data = ['success' => 1];
//        return response() -> json($data);

        return $post;
    }

    public function show($id) {

        $post = Post::where($id);

        return $post;
    }

    public function edit(Request $request, $id) {
        $title = $request['title'];
        $content = $request['content'];
        $user_id = auth() -> user()['id'];

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

        $post = Post::findOrFail($id) -> where('user_id', $user_id) -> get();
        if($post ==null) {
            $data = ['success' => 0, 'error' => '해당 유저가 아님'];
            return response() -> json($data);
        }

        $post -> title = $title;
        $post -> content = $content;

        if($request -> file('imageFile')) {
            $imagePath = 'public/images/'.$post->image;
            Storage::delete($imagePath);
            $post -> image = $this -> uploadPostImage($request);
        }

        $post -> save();

        return $post;

    }

    public function delete($id) {

        $user_id = auth() -> user()['id'];
        $post = Post::findOrFail($id) -> where('user_id',$user_id);
        if($post != null) {
            $data = ['success'=> 0 , 'error' => '해당 게시판 유저가 아닙니다.'];
            return response() -> json($data);
        }

        if($post -> img){
            $imagePath = 'public/images/'.$post -> image;
            Storage::delete($imagePath);
        }

        $post -> delete();

        $data = ['success'=> 0];
        return response() -> json($data);
    }




    private function uploadPostImage($request) {

        $extension = $request -> file('imageFile') -> extension();
        $name = $request -> file('imageFile') -> getClientOriginalName();
        $nameWithoutExtension = Str::of($name) -> basename('.'.$extension);
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;

        $request -> file('imageFile') -> storeAs('public/images', $fileName);

        return $fileName;
    }
}
