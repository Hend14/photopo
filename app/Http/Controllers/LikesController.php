<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Like;

class LikesController extends Controller
{
    public function like(Post $post, Request $request)
    {
        $like = Like::create(['user_id' => $request->user_id, 'post_id' => $post->id]);
        $likeCount = count(Like::where('post_id', $post->id)->get());

        return response()->json(['likeCount' => $likeCount]);
    }

    public function unlike(Post $post, Request $request)
    {
        $like = Like::where('user_id', $request->user_id)->where('post_id', $post->id)->first();
        $like->delete();

        $likeCount = count(Like::where('post_id', $post->id)->get());

        return response()->json(['likeCount' => $likeCount]);
    }
}

