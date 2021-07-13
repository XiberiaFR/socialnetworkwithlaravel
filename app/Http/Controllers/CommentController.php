<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'comment-content' => ['required', 'string', 'max:500'],
            'pomgo-id-comment' => ['required', 'integer'],
            'image_comment' => ['mimes:jpeg,png,jpg,gif,svg|max:2048'],
        ]);
        
        if(!empty($request->image_comment)) {
        $imageName = time() . '.' . $request->image_comment->extension();
        $request->image_comment->move(public_path('images'), $imageName);
        }

        Comment::create([
            'content' => $request->input('comment-content'),
            'pomgo_id' => $request->input('pomgo-id-comment'),
            'user_id' => Auth::user()->id,
        ]);
        
        if(!empty($request->image_comment)) {
        Comment::create([
            'image' => $imageName,
        ]);
        }
        
        return back()
            ->with('message', 'Félicitations, votre commentaire est publié.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
