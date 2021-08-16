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

        $posts = Post::join('users', 'posts.user_id', '=','users.id') ->
            select('posts.*','users.name') -> latest() -> paginate(5);
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


//        $post = Post::create([
//            'title' => $title,
//            'content' => $content,
//            'user_id' => $user_id,
//            'img' => $this -> uploadPostImage($request)
//        ]);

        $post = new Post();
        $post -> title = $title;
        $post -> content = $content;
        $post -> user_id = $user_id;

        if($request-> file('imgFile'))
        {
            $post -> img = $this -> uploadPostImage($request);
        }

        $post -> save();

//        $data = ['success' => 1];
//        return response() -> json($data);

        return $post;
    }

    public function show($id) {

        $post = Post::join('users', 'posts.user_id', '=','users.id') ->
        select('posts.*','users.name') -> find($id);

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
        $post = Post::where('user_id',$user_id) -> findOrFail($id);
        if($post == null) {
            $data = ['success'=> 0 , 'error' => '해당 게시판 유저가 아닙니다.'];
            return response() -> json($data);
        }

        if($post -> img){
            $imagePath = 'public/images/'.$post -> image;
            Storage::delete($imagePath);
        }

        $post -> delete();

        $data = ['success'=> 1];
        return response() -> json($data);
    }




    private function uploadPostImage($request) {

        $extension = $request -> file('imgFile') -> extension();
        $name = $request -> file('imgFile') -> getClientOriginalName();
        $nameWithoutExtension = Str::of($name) -> basename('.'.$extension);
        $fileName = $nameWithoutExtension . '_' . time() . '.' . $extension;

        $request -> file('imgFile') -> storeAs('public/img', $fileName);

        return $fileName;
    }
}
