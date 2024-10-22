<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function postForm()
    {
        $categories = Category::SELECT('id', 'title', 'description', 'updated_at')->whereNull('deleted_at')->get();
        return view('Post.postForm', compact(['categories']));
    }

    public function postPost(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $posts = new Post();
        $posts->title       = $request->title;
        $posts->description = $request->description;
        $posts->content     = $request->content;
        $posts->category_id = $request->category_id;
        $posts->created_at  = Carbon::now();
        $posts->updated_at  = Carbon::now();
        $posts->created_by  = Auth::guard('Admin')->user()->name;
        $posts->updated_by  = Auth::guard('Admin')->user()->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uniqueName = self::getUploadImage($image);
            $image->move(public_path('uploads'), $uniqueName);
            $posts->image = 'uploads/' . $uniqueName;
        }

        $posts->save();

        if ($posts) {
            return redirect()->route('postListing')->with('success_msg', 'Data insert Successful!');
        } else {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    public static function getUploadImage($image)
    {
        $extension = $image->getClientOriginalExtension();
        $uniqueName = date('Ymd_His') . '_' . uniqid() . "." . $extension;
        return $uniqueName;
    }


    public function postListing()
    {
        $posts = Post::SELECT('id', 'title', 'description', 'image', 'category_id', 'updated_at')->whereNull('deleted_at')->get();
        return view('post.postListing', compact(['posts']));
    }

    public function postEdit($id)
    {
        $categories = Category::SELECT('id', 'title', 'description', 'updated_at')->whereNull('deleted_at')->get();
        $post_data = Post::find($id);
        $selectedCategoryId = $post_data->category_id;
        return view('Post.postForm', compact(['categories', 'post_data', 'selectedCategoryId']));
    }

    public function postUpdate(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);

        $post->title       = $request->title;
        $post->description = $request->description;
        $post->content     = $request->content;
        $post->category_id = $request->category_id;
        $post->updated_at  = Carbon::now();
        $post->created_by  = Auth::guard('Admin')->user()->name;
        $post->updated_by  = Auth::guard('Admin')->user()->name;

        if ($request->hasFile('image')) {
            if ($post->image) {
                $oldImagePath = public_path($post->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('image');
            $uniqueName = self::getUploadImage($image);
            $image->move(public_path('uploads'), $uniqueName);

            $post->image = 'uploads/' . $uniqueName;
        }

        $post->save();

        if ($post) {
            return redirect()->route('postListing')->with('updateSuccess_msg', 'Data update successful!');
        } else {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }


}
