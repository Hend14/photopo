<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (Auth::check()) {
            $user = Auth::user();
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(5);

            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }

        return view('posts.index', $data);
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

        if($request->file('post_img')->isValid())
        {
            $request->post_img = $request->post_img;
            $path = $request->post_img->storeAs('public/postImg',Auth::id() . '_post.jpg');
        }

        $request->user()->posts()->create([
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
        $auth = Auth::user();
        $posts = Post::find($id)->orderBy('created_at', 'desc')->paginate(5);

        $data = [
            'auth' => $auth,
            'posts' => $posts,
        ];

        $data += $this->counts($posts);

        return view('posts.show', $data);
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
