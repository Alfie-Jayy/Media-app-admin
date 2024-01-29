<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function list(){
        $users = User::when(request('key'), function($query){
            $query -> orWhere('name', 'like', '%'.request('key').'%')
            -> orWhere('email', 'like', '%'.request('key').'%')
            -> orWhere('phone', 'like', '%'.request('key').'%')
            -> orWhere('address', 'like', '%'.request('key').'%')
            -> orWhere('gender', request('key'));
        })->get();
        return view('admin.List.list', compact('users'));
    }

    // account delete
    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->route('admin#list')->with(['deleteSuccess' => 'Successfully deleted an account!']);
    }
}
