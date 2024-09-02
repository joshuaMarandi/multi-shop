<?php


namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->except(['index', 'show', 'create', 'store']);
    }


    // Display a list of all shops
    public function index()
    {
        $shops = Shop::all();
        return view('shops.index', compact('shops'));
    }

    
    // Show the form for creating a new shop
    public function create()
    {
        return view('shops.create');
    }

    // Store a newly created shop in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Shop::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Shop added successfully.');
    }

    // Display the specified shop
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return view('shops.show', compact('shop'));
    }

    // Show the form for editing the specified shop
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        return view('shops.edit', compact('shop'));
    }

    // Update the specified shop in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $shop = Shop::findOrFail($id);
        $shop->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Shop updated successfully.');
    }

    // Remove the specified shop from the database
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Shop deleted successfully.');
    }

    
}
