<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::simplePaginate(), 200);

    }

    public function show($id)
    {
        return response()->json(User::find($id), 200);
    }


}
