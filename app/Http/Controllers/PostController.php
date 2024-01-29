<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\actionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function postList()
    {
        $posts = Post::select('posts.*', 'categories.title as category_title')

        ->when(request('key'), function($query){
            $query
            -> orWhere('categories.title', 'like', '%'.request('key').'%')
            -> orWhere('posts.title', 'like', '%'.request('key').'%')
            -> orWhere('posts.description', 'like', '%'.request('key').'%');
        })
        ->leftJoin('categories', 'posts.category_id', 'categories.category_id')
        ->get();
        return view('admin.Post.list', compact('posts'));
    }

    // create Post Page
    public function createPost()
    {
        $categories = Category::get();
        $posts = Post::select('posts.*', 'categories.title as category_title')

        ->when(request('key'), function($query){
            $query
            -> orWhere('categories.title', 'like', '%'.request('key').'%')
            -> orWhere('posts.title', 'like', '%'.request('key').'%')
            -> orWhere('posts.description', 'like', '%'.request('key').'%');
        })

            ->leftJoin('categories', 'posts.category_id', 'categories.category_id')->get();
        return view('admin.Post.create', compact('categories', 'posts'));
    }

    // post Create Btn
    public function postCreateBtn(Request $req)
    {
        $this->postValidation($req);
        $data = $this->postGetData($req);

        // image
        if ($req->hasFile('postImage')) {
            $image = $req->file('postImage');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }

        Post::create($data);
        return redirect()->back()->with(['createSuccess' => 'Your post is successfully created!']);
    }

    //post Delete
    public function postDelete($id)
    {
        $data = Post::where('post_id', $id)->first();

        if($data->image){
            Storage::delete('public/'.$data->image);
        }
        Post::where('post_id', $id)->delete();
        actionLog::where('post_id', $id)->delete();
        return redirect()->back();
    }

    //post Edit
    public function postEdit($id)
    {

        $categories = Category::get();
        $post = Post::where('post_id', $id)->first();
        $posts = Post::select('posts.*', 'categories.title as category_title')
        ->when(request('key'), function($query){
            $query
            -> orWhere('categories.title', 'like', '%'.request('key').'%')
            -> orWhere('posts.title', 'like', '%'.request('key').'%')
            -> orWhere('posts.description', 'like', '%'.request('key').'%');
        })
            ->leftJoin('categories', 'posts.category_id', 'categories.category_id')->get();
        return view('admin.Post.edit', compact('categories', 'post', 'posts'));
    }


    //photo Delete
    public function photoDelete($id)
    {
        $data = Post::where('post_id', $id)->first();
        $imageName = $data->image;
        Storage::delete('public/' . $imageName);
        Post::where('post_id', $id)->update(['image' => null]);
        return redirect()->back();
    }

    // post Update
    public function postUpdate(Request $req, $id)
    {
        $this->postValidation($req);
        $data = $this->postGetData($req);

        // image
        if ($req->hasFile('postImage')) {
            $image = $req->file('postImage');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->storeAs('public', $imageName);
            $data['image'] = $imageName;
        }

        Post::where('post_id', $id)->update($data);
        return redirect()->back()->with(['updateSuccess' => 'Your post is successfully updated!']);
    }

        //view Post Detail
        public function viewPost(Request $req){

            $post = Post::select('posts.*', 'categories.title as category_name')
            ->join('categories', 'posts.category_id', 'categories.category_id')
            ->where('posts.post_id', $req->id)->first();

            return view('admin.Post.viewPostDetails', compact('post'));
        }


    //post Create Validation
    private function postValidation($req)
    {
        Validator::make($req->all(), [
            'postCategory' => 'required',
            'postName' => 'required',
            'postDescription' => 'required',
            'postImage' => 'mimes:jpg,jpeg,png'
        ])->validate();
    }

    //post get Data
    private function postGetData($req)
    {
        return [
            'category_id' => $req->postCategory,
            'title' => $req->postName,
            'description' => $req->postDescription
        ];
    }
}
