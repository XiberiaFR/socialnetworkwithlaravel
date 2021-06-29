<?php

namespace App\Http\Controllers;

use App\Models\User
use Illuminate\Http\Request;

class VueController extends Controller
{
    public function index()
{
    return response()->json(users::all());
}
}
