<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
        $user = Auth::user();
        $post = Post::find($user->id);
        $posts = $post->orderBy('created_at', 'desc')->paginate(5);
        }

        return view('posts.index', compact("user", "posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:150',
            'post_img' => 'nullable|image',
        ]);

        $post = new Post;
        //ファイルが選択されていればs3の'post_img'フォルダへアップロード、なければnull
        if($request->hasFile('post_img'))
        {
            $image = $request->file('post_img');
            $path = Storage::disk(config('filesystems.default'))->putFile('post_img', $image, 'public');
            //画像のパスを取得（post_imgカラム）
            $post->post_img = Storage::disk(config('filesystems.default'))->url($path);
        } else {
            $post->post_img = null;
        }


        $post = $request->user()->posts()->create([
            'content' => $request->content,
            'post_img' => $request->post_img,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $posts = Post::find($id)->orderBy('created_at', 'desc')->paginate(5);

        return view('posts.show', compact("user", "posts"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if (Auth::id() === $post->user_id) {
            $post->delete();
        }

        return back();
    }
}
