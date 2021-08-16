<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'blogs' => $blogs,
        ],200);
    }
    public function allCategories(){
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ],200);
    }
    public function show($blogId)
    {
        $blog = Post::with('user','category')->where('id',$blogId)->first();
        return response()->json([
            'blog' => $blog,
        ],200);
    }
    public function getAllPostsByCatId($catId){
        $blogs = Post::with('user','category')->where('category_id',$catId)->orderBy('id','desc')->get();
        return response()->json([
            'posts' => $blogs,
        ],200);
    }

    public function searchResult(Request $request){
        $txt = $request->get('q');
        if ($txt != null) {
            $blogs = Post::with('user','category')
                    ->where('title','LIKE',"%$txt%")
                    ->orWhere('description','LIKE',"%$txt%")
                    ->get();
            return response()->json([
                'blogs' => $blogs,
            ],200);
        }else{
            return $this->index();
        }
    }

    public function getLatestBlogs(){
        $posts = Post::with('user','category')->orderBy('id','desc')->get();
        return response()->json([
            'posts' => $posts,
        ],200);
    }
}
