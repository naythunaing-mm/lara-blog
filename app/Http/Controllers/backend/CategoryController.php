<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function categoryForm()
    {
        return view('category.categoryForm');
    }

    public function postCategory(Request $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->created_at = Carbon::now();
        $category->updated_at = Carbon::now();
        $category->created_by = Auth::guard('Admin')->user()->name;
        $category->updated_by = Auth::guard('Admin')->user()->name;
        $category->save();

        if ($category) {
            return redirect()->route('categoryForm')->with('success_msg', 'Data insert Successful!');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong!');
        }
    }

    public function editCategoryForm($id)
    {
        $category_data = Category::find($id);
        return view('category.categoryForm', compact(['category_data']));
    }

    public function categoryListing()
    {
        $categories = Category::SELECT('id', 'title', 'description', 'updated_at')->whereNull('deleted_at')->get();
        return view('category.categoryListing', compact(['categories']));
    }

    public function updateCategory(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->updated_at = Carbon::now();
        $category->updated_by = Auth::guard('Admin')->user()->name;
        $category->save();
        if ($category) {
            return redirect()->route('categoryListing')->with('updateSuccess_msg', 'Data insert Successful!');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong!');
        }
    }
}
