<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $posts = $user->feed_posts()->orderBy('created_at', 'desc')->paginate(5);
            $path = Storage::disk(config('filesystems.default'))->url('$post_img');
        }
        return view('welcome', compact('user', 'posts', 'path'));
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
        $content_max_length = config('common.content_max_length');
        $image_max_size = config('common.image_max_size');
        $this->validate($request, [
            'content' => "required|max:$content_max_length",
            'post_img' => "nullable|image|max:$image_max_size",
        ]);

        $post = new Post;
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        //ファイルが選択されていればs3へアップロード,post_imgカラムにパスを保存
        if ($request->hasFile('post_img')) {
            // MEMO: リサイズ処理（GD, Imagemagick）
            // Service層を導入してImageServiceクラスの関数に移す
            // 入力：$request->file('post_img')、返り値：S3上の画像パス
            $post->post_img = Storage::disk(config('filesystems.default'))->putFile('/post_img', $request->file('post_img'), 'public');
        } else {
            $request->post_img = null;
        }

        // dd(Storage::disk(config('s3'))->url($post->post_img));

        $post->save();

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
            \Session::flash('flash_message', '削除しました。');
        }

        return back();
    }
}
