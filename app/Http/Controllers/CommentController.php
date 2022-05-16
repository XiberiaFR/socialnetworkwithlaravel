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
        $imageName = 'noimage';
        if(!empty($request->image_comment)) {
        $imageName = time() . '.' . $request->image_comment->extension();
        $request->image_comment->move(public_path('images'), $imageName);
        }

        Comment::create([
            'content' => $request->input('comment-content'),
            'pomgo_id' => $request->input('pomgo-id-comment'),
            'user_id' => Auth::user()->id,
            'image' => $imageName,
        ]);

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
        return view('comments.edit', compact('comment'));
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
        $request->validate([
            'comment-content' => ['required', 'string', 'max:500'],
            'image_comment' => ['mimes:jpeg,png,jpg,gif,svg|max:2048'],
            'pomgo-id-comment' => ['required', 'integer'],
        ]);

        $comment->content = $request->input('comment-content');
        if(!empty($request->image_comment)) {
            $comment->image = $request->input('image_comment');
        }
        $comment->pomgo_id = $request->input('pomgo-id-comment');        
        $comment->save();
        return redirect('home')->with('message', 'Félicitations, commentaire modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()
            ->with('message', 'Félicitations, votre commentaire est supprimé');
    }
}
