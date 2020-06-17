<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function store(Request $request, $id)
    {
        $like = \Auth::user()->like($id);

        return back();
    }

    public function destroy($id)
    {
        $unlike = \Auth::user()->unlike($id);

        return back();
    }


}
