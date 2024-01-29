<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function postList(){
        $posts = Post::select('posts.*', 'categories.title as category_title')
        ->join('categories', 'posts.category_id', 'categories.category_id')
        ->get();
        return response()->json([
            'status' => 'success',
            'posts' => $posts
        ]);
    }

    //post Details
    public function postDetails(Request $req){
        $posts = Post::where('post_id', $req->id)->first();
        logger($posts);
        return response()->json([
            'post' => $posts
        ]);
    }

    //search Posts
    public function searchPost(Request $req){
        $posts = Post::orWhere('title','like','%'.$req->key.'%')
            ->orWhere('description','like','%'.$req->key.'%')->get();
        return response()->json([
            'searchData' => $posts
        ]);
    }
}
