<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function postList()
    {
        $post = Post::whereNull('deleted_at')->get();
        foreach ($post as $posts) {
            $posts->truncated_description = Str::limit($posts->description, 150);
        }
        return response()->json([
            'post' => $post
        ]);
    }

    public function postDetail(Request $request)
    {
        $id = $request->postID;
        $post = Post::with('category:id,title,description')
                ->find($id);
        return response()->json([
            'post' => $post
        ]);
    }
}
