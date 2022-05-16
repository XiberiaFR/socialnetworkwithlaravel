<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pomgo;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\ResultType\Success;

class PomgoController extends Controller
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
            'pomgo_text' => ['required', 'string', 'max:500'],
            'pomgo_img' => ['required', 'string'],
        ]);
        Pomgo::create([
            'content' => $request->input('pomgo_text'),
            'image' => $request->input('pomgo_img'),
            'tags' => $request->input('pomgo_tags'),
            'user_id' => Auth::user()->id,
    ]);
    return back()
    ->with('message', 'Félicitations, votre pomgo est publié.');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pomgo $pomgo)
    {
        return view('pomgo.edit', compact('pomgo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pomgo $pomgo)
    {
        $request->validate([
            'pomgo_text' => ['required', 'string', 'max:500'],
            'pomgo_img' => ['string'],
        ]);
        $pomgo->content = $request->input('pomgo_text');
        if(!empty($request->pomgo_img)) {
            $pomgo->image = $request->input('pomgo_img');
        }        
        $pomgo->tags = $request->input('pomgo_tags');
        $pomgo->save();
        return redirect('home')->with('message', 'Félicitations, pomgo modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pomgo $pomgo)
    {
        $pomgo->delete();
        return back()
            ->with('message', 'Félicitations, votre pomgo est supprimé');
    }

    public function search(Request $request, Pomgo $pomgo)
    {

        $recherche = trim($request->get('q'));

        $pomgo = Pomgo::query()
            ->where('content', 'like', "%{$recherche}%")
            ->orWhere('tags', 'like', "%{$recherche}%")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('search', [
            'recherche' => $recherche,
            'pomgos' => $pomgo,
        ]);
    }

}
