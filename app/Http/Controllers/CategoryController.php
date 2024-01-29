<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categoryList(){
        $categories = Category::when(request('key'), function($query){
            $query -> orWhere('title','like','%'.request('key').'%')
            -> orWhere('description','like','%'.request('key').'%');
        })->get();

        return view('admin.Category.list', compact('categories'));
    }


    //category Create Page
    public function categoryCreate(){
        $categories = Category::when(request('key'), function($query){
            $query -> orWhere('title','like','%'.request('key').'%')
            -> orWhere('description','like','%'.request('key').'%');
        })->get();
        return view('admin.Category.create', compact('categories'));
    }

    //Category Create Btn
    public function categoryCreateBtn(Request $req){
        $this->categoryValidate($req);
        $data = $this->categoryData($req);
        Category::create($data);
        $categoryTitle = $data['title'];
        return redirect()->back()->with(['createSuccess' => "$categoryTitle is successfully created!"]);
    }

    //delete Category
    public function deleteCategory($id){
        Category::where('category_id', $id)->delete();
        return back();
    }

    //edit Category
    public function editCategory($id){
        $categories = Category::when(request('key'), function($query){
            $query -> orWhere('title','like','%'.request('key').'%')
            -> orWhere('description','like','%'.request('key').'%');
        })->get();
        $category = Category::where('category_id', $id)->first();
        return view('admin.Category.edit', compact('categories','category'));
    }


    //Category update Btn
    public function categoryUpdateBtn(Request $req, $id){
        $this->categoryValidate($req);
        $data = $this->categoryData($req);
        Category::where('category_id', $id)->update($data);
        return redirect()->back()->with(['updateSuccess' => 'A category is successfully updated!']);
    }



    // Category Validate
    private function categoryValidate($req){
        Validator::make($req->all(), [
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ])->validate();
    }

    // category get Data
    private function categoryData($req){
        return [
            'title' => $req->categoryName,
            'description' => $req->categoryDescription
        ];
    }
}
