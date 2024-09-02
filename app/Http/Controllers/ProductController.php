<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Import the Category model

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id', // Ensure category_id exists
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer'
        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'shop_id' => auth()->user()->shop_id // Assuming shop_id is stored in the user session
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function index()
    {
        $products = Product::where('shop_id', auth()->user()->shop_id)->get();
        $lowInventory = $products->filter(function ($product) {
            return $product->stock_quantity < 10; // Example threshold
        });
        
        return view('products.index', compact('products', 'lowInventory'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // Fetch all categories for the edit form
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id', // Ensure category_id exists
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
}
