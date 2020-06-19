<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Location;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);

        return view('users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(5);

        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        //都道府県情報
        $location_list = Location::select('code', 'prefecture')->pluck('prefecture', 'code');

        return view('users.edit', [ 'user' => $user, 'location_list' => $location_list]);
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
        $this->validate($request,[
            'name' => "required",
            'email' => "required",
            ]);
        
        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->location_id = $request->location_id;
        //プロフィール画像をs3のuser_imgにアップロード
        $this->validate($request, [
            'post_img' => 'nullable|image',
        ]);

        if ($request->hasFile('profile_img'))
        {
            $user->profile_img = Storage::disk(config('filesystems.default'))->put('/user_img', $request->file('profile_img'), 'public');

            // dd(Storage::disk(config('s3'))->url($user->profile_img));
        }

        $user->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function account()
    {
        $user = Auth::User();

        return view('users.account', ['user' => $user]);
    }

    public function softdelete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();

        return redirect('/');
    }

    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(5);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(5);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }

    public function likes($id)
    {
        $user = User::find($id);
        $likes = $user->likes()->paginate(10);

        $data = [
            'user' => $user,
            'posts' => $likes,
            ];

            $data += $this->counts($user);

            return view('users.likes', $data);
    }
}