<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
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
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $path = Storage::disk(config('filesystems.default'))->url('$post_img');

        return view('posts.index', compact('user', 'posts', 'path'));
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
        $post->content = $request->content;
        $post->user_id = $request->user()->id;
        //ファイルが選択されていればs3へアップロード,post_imgカラムにパスを保存
        if($request->hasFile('post_img'))
        {
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
