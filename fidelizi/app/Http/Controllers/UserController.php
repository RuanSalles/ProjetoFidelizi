<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return new \App\Http\Resources\User(User::all());
    }

    public function show($id)
    {
        return response()->json(User::find($id), 200);
    }

    public function getActiveFidelityUsers()
    {
        return response()->json(User::FidelityProgramActive()->orderBy('id')->get(), 200);
    }

    public function activeUserFidelityProgram($id)
    {
        User::where('id', $id)->update(['fidelity_program' => true]);

        return response()->json(User::where('id', $id)->update(['fidelity_program' => true]), '200');
    }
}
