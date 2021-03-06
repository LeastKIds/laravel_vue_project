<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index() {

        $posts = Post::join('users', 'posts.user_id', '=','users.id') ->
            select('posts.*','users.name',
            DB::raw('DATE_FORMAT(posts.created_at,"%Y-%m-%d %h:%i %p") as day')) -> latest() -> paginate(5);

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


        $post = new Post();
        $post -> title = $title;
        $post -> content = $content;
        $post -> user_id = $user_id;

        if($request-> file('imgFile'))
        {
            $post -> img = $this -> uploadPostImage($request);
        }

        $post -> save();


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

        $post = Post::where('user_id', $user_id) -> findOrFail($id);
        if($post ==null) {
            $data = ['success' => 0, 'error' => '?????? ????????? ??????'];
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
            $data = ['success'=> 0 , 'error' => '?????? ????????? ????????? ????????????.'];
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

    public function search($word) {
//        return $word;
        $posts = Post::join('users', 'posts.user_id', '=','users.id') -> where('title', 'like','%'.$word.'%') ->
        select('posts.*','users.name',
            DB::raw('DATE_FORMAT(posts.created_at,"%Y-%m-%d %H:%i") as day')) -> latest() -> paginate(5);

        return $posts;
    }

    public function myPosts() {

        $id = auth() -> user()['id'];

        $posts = Post::join('users', 'posts.user_id', '=','users.id') -> where('user_id',$id) ->
        select('posts.*','users.name',
            DB::raw('DATE_FORMAT(posts.created_at,"%Y-%b-%d") as day')) -> latest() -> paginate(5);

        return $posts;
    }

    public function mySearch($word) {

        $id = auth() -> user()['id'];

        $posts = Post::join('users', 'posts.user_id', '=','users.id') -> where('user_id',$id) ->
        where('title', 'like','%'.$word.'%') ->
        select('posts.*','users.name',
            DB::raw('DATE_FORMAT(posts.created_at,"%Y-%b-%d") as day')) -> latest() -> paginate(5);

        return $posts;
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
