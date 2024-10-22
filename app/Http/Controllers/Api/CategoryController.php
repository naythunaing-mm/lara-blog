<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList()
    {
        $category = Category::SELECT("id", "title", "description", "created_at", "updated_at", "created_by", "updated_by")->whereNull("deleted_at")->get();
        return response()->json([
            "category" => $category
        ]);
    }
}
