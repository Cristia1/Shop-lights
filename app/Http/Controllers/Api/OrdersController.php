<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return redirect()->route('orders.index')->with('orders', $orders);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
        ]);

        $productId = $validatedData['product_id'];
        $productName = $validatedData['name'];
        $productPrice = $validatedData['price'];
        $quantity = $validatedData['quantity'];

        // calculate total price of order
        $total = $productPrice * $quantity;

        $order = new Order();

        $order->name = $productName;
        $order->price = $productPrice;
        $order->quantity = $quantity;
        $order->total = $total;
        $order->save();

        // actualizare variabilă $order cu noua comandă creată
        $order = $order->fresh();

        $orders = Order::all();

        return redirect()->route('orders.index')->with('orders', $orders);
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        return view('orders.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->name = $request->input('name');
        $order->price = $request->input('price');
        $order->quantity = $request->input('quantity');
        $order->total = $request->input('total');
        $order->save();

        $orders = Order::all();

        return redirect()->route('orders.index')->with('orders', $orders);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        $orders = Order::all();

        return redirect()->route('orders.index')->with('orders', $orders);
    }

    public function addToCart(Request $request)
    {
        $order = new Order();
        // $order->product_id = $request->input('product_id');
        $order->name = $request->input('name');
        $order->price = $request->input('price');
        $order->quantity = $request->input('quantity');
        $order->total = $order->price * $order->quantity; // calculați totalul aici
        $order->save();

        $orders = Order::all();

        return redirect()->route('orders.index')->with('orders', $orders);
    }
}
