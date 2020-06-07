<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationsController extends Controller
{
    public function list ()
    {
        $location_list = Location::orderBy('code', 'asc')->pluck(['prefecture', 'code']);

        return view('users.edit', compact('location_list'));

    }
}
