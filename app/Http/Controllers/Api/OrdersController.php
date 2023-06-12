<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        // dd($orders);

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
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            return response()->json(['status' => false]);
        }

        if ($request->id) {
            $order = new Order();
            $order->product_id = $request->id;
            $order->user_id = $user_id;
            $order->save();

            // aici numara cate produse am in baza de date
            $orders = Order::where('user_id', $user_id)->count();
            // dd($order);

            return response()->json(['status' => true, 'cartCount' => $orders]);
        }

        return response()->json(['status' => false]);
    }

    public function getCountOrders(Request $request)
    {
        $index_card_items = Order::where('user_id', $request->user()->id)->count();
        dd($request->all());

        return response()->json(['index-card-items' => $index_card_items]);
    }
}
