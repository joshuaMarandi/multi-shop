<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all shops
        $shops = Shop::all();

        // Pass shops data to the view
        return view('admin.dashboard', compact('shops'));
    }

    public function createAttendant()
    {
        // Fetch all shops to display in the attendant creation form
        $shops = Shop::all();
        return view('admin.attendants.create', compact('shops'));
    }

    public function storeAttendant(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'shop_id' => 'required|exists:shops,id',
        ]);

        // Create a new attendant user with the provided data
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'attendant',  // Set the role to 'attendant'
            'shop_id' => $request->shop_id,  // Assign the user to the selected shop
        ]);

        // Redirect to the admin dashboard with a success message
        return redirect()->route('admin.dashboard')->with('success', 'Attendant added successfully.');
    }
}
