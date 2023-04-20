<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->name = $request->input('product_name');
        $order->price = $request->input('product_price');
        $order->quantity = $request->input('quantity');
        $order->total = $request->input('product_price') * $request->input('quantity');
        $order->save();

        // Actualizăm variabila de sesiune cart_count cu numărul actual de produse din coșul de cumpărături
        session(['cart_count' => auth()->user()->orders()->count()]);

        return redirect()->route('orders.index');
    }

    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found');
        }

        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::find($id);

        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->name = $request->input('name');
        $order->price = $request->input('price');
        $order->quantity = $request->input('quantity');
        $order->total = $request->input('total');
        $order->save();

        return redirect()->route('orders.index');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect()->route('orders.index');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('shop.index')->with('error', 'Product not found!');
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('shop.index')->with('success', 'Product added to cart!');
    }
}
