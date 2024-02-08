<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\actionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendPostController extends Controller
{
    public function trendPost(){

        $posts = actionLog::select('action_logs.*', 'posts.*', DB::raw('COUNT(action_logs.post_id) as view_count'))
        ->when(request('key'), function($query){
            $query
            -> orWhere('posts.title', 'like', '%'.request('key').'%');
        })
        ->leftJoin('posts', 'posts.post_id', 'action_logs.post_id')
        ->groupBy('action_logs.post_id')
        ->get();

        return view('admin.TrendPost.trendPost', compact('posts'));
    }
}
