<?php

namespace App\Http\Controllers\Api;

use App\Models\actionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActionLogController extends Controller
{
    //view counts
    public function viewCount(Request $req){
        $data = [
            'user_id' => $req->user_id,
            'post_id' => $req->post_id
        ];

        actionLog::create($data);

        $viewPost = actionLog::where('post_id', $req->post_id)->get();

        return response()->json([
            'viewPosts' => $viewPost
        ]);
    }
}
