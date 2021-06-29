<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        return view('user.account', ['user' => $user]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pomgoname)
    {
        return view('user.profile', ['pomgoname' => $pomgoname]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'pomgoname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'current_password' => ['required', new MatchOldPassword],
        ]);
        $user->prenom = $request->input('firstname');
        $user->nom = $request->input('name');
        $user->pomgoname = $request->input('pomgoname');

        if (!empty($request->input('new_password'))) {
            $request->validate([
                'new_password' => ['different:current_password', 'required', 'confirmed', 'string', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()],
            ]);
            $user->password = Hash::make($request->input('new_password'));
        }

        $user->save();
        return redirect('home')->with('message', 'Félicitations, informations modifiées');
    }
}
