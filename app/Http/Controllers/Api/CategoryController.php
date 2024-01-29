<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function categoryList(){
        $categories = Category::get();
        return response()->json([
            'status' => 'success',
            'category' => $categories
        ]);
    }

    public function categoryNav(Request $req){
        if($req->id){

            $posts = Post::select('posts.*','categories.title as category_title')
                ->join('categories', 'posts.category_id', 'categories.category_id')
                ->where('posts.category_id', $req->id)->get();

                return response()->json([
                'status' => 'success',
                'posts' => $posts
            ]);

        }else{
            $posts = Post::select('posts.*', 'categories.title as category_title')
                    ->join('categories', 'posts.category_id', 'categories.category_id')
                    ->get();

                return response()->json([
                'status' => 'success',
                'posts' => $posts
            ]);
        }
    }
}
