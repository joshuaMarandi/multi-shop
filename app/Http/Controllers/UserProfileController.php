<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function show()
    {
        // Fetch the authenticated user's information
        $user = Auth::user();

        // Pass the user data to the profile view
        return view('profile.show', compact('user'));
    }
}
