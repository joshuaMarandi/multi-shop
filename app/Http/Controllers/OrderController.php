<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('shop_id', auth()->user()->shop_id)->with('user')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        // Fetch users, products, and customers for the order form
        $users = User::all();
        $products = Product::where('shop_id', auth()->user()->shop_id)->get();
        $customers = Customer::all(); // Fetch all customers

        return view('orders.create', compact('users', 'products', 'customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'product_ids' => 'required|array',
            'quantities' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities.*' => 'integer|min:1',
        ]);

        // Find or create the customer
        $customer = Customer::firstOrCreate(['name' => $request->customer_name]);

        // Calculate total amount and prepare order items
        $totalAmount = 0;
        $orderItems = [];
        foreach ($request->product_ids as $index => $productId) {
            $product = Product::find($productId);
            $quantity = $request->quantities[$index];
            $price = $product->price;

            $totalAmount += $price * $quantity;
            $orderItems[] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'shop_id' => auth()->user()->shop_id,
            'customer_id' => $customer->id,
            'total_amount' => $totalAmount,
            'status' => 'pending', // Default status
        ]);

        // Add order items
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }

    public function generateInvoice($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        // Logic for generating invoice (PDF or other formats)
        return view('orders.invoice', compact('order'));
    }
}
