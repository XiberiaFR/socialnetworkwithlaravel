<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Pomgo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pomgos = Pomgo::all()->sortByDesc('created_at');
        $pomgos->load('user', 'comments.user');
        return view('home', compact('pomgos'));
    }
}
