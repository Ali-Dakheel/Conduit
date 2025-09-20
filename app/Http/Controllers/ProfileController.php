<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function show(string $username)
    {
        $author = User::getProfileByUsername( $username);
        return view('profile.show', ['author' => $author]);
    }
}
