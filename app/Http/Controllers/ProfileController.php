<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show(string $username)
    {
        $author = User::getProfileByUsername($username);
        return view('profile.show', ['author' => $author]);
    }

    public function store(User $user)
    {
        auth()->user()->following()->syncWithoutDetaching([$user->id]);
        return back()->with('message', 'User followed successfully');
    }

    public function destroy(User $user)
    {
        auth()->user()->following()->detach($user->id);

        return back()->with('message', 'User unfollowed successfully');
    }
}
