<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VueController extends Controller
{
    public function index()
{
    return response()->json(User::all());
}

public function show(User $user)
{
    return response()->json($user);
}
}
