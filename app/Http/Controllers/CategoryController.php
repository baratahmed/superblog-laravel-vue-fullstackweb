<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    // public function __construct(){
    //     $this->middleware('auth');
    // }

    public function index()
    {
         $categories = Category::select('id','cat_name','created_at')->get();
         return response()->json([
             'categories' => $categories,
         ],200);
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'cat_name' => 'required|min:2|max:12',
        ]);
        $category = new Category();
        $category->cat_name = $request->cat_name;
        $category->save();
        return [
            'message' => 'OK',
        ];
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json([
            'category' => $category,
        ],200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'cat_name' => 'required|min:2|max:12',
        ]);
        $category = Category::find($id);
        $category->cat_name = $request->cat_name;
        $category->save();
        return [
            'message' => 'Updated',
        ];
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }

    public function deleteSelectedCategories($ids){
        $all_ids = explode(',',$ids);
        foreach ($all_ids as $id) {
            $category = Category::find($id);
            $category->delete();
        }
    }
}
