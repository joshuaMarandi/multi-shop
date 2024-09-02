<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class AttendantController extends Controller
{
    // Display the attendant dashboard with shop information
    public function index($shopId)
    {
        // Fetch shop-specific data
        $shop = Shop::findOrFail($shopId);

        // Pass shop data to the view
        return view('attendant.dashboard', compact('shop'));
    }

    // Method to ensure attendants see the correct shop details
    public function dashboard()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user has the role of an attendant
        if ($user->role !== 'attendant') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }

        // Fetch the shop assigned to the attendant
        $shop = Shop::findOrFail($user->shop_id);

        // Pass shop data to the view
        return view('attendant.dashboard', compact('shop'));
    }
}
