<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts' => $posts,
        ],200);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(200, 200);
        $upload_path = public_path()."/uploadimage/";
        $img->save($upload_path.$name);
        $post = new Post();
        $post->category_id = $request->category_id;
        $post->user_id = auth()->id();
        $post->comment_id = 1;

        $post->title = $request->title;
        $post->description = $request->description;
        $post->photo= $name;

        $post->save();
        return response()->json([
            'msg' => 'Done',
        ]);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $post = Post::find($id);
        return response()->json([
            'post'=>$post
        ],200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);

        $post = Post::find($id);

        if($request->photo!=$post->photo){
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(200, 200);
            $upload_path = public_path()."/uploadimage/";
            $image = $upload_path. $post->photo;
            $img->save($upload_path.$name);

            if(file_exists($image)){
                @unlink($image);
            }
        }else{
            $name = $post->photo;
        }

        $post->category_id = $request->category_id;
        $post->user_id = auth()->id();
        $post->comment_id = 1;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->photo = $name;
        $post->save();
        return response()->json([
            'msg' => 'Done',
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $image_path = public_path()."/uploadimage/";
        $image = $image_path. $post->photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $post->delete();
    }
}
