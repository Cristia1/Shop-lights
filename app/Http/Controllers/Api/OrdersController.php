<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $totalAmount = $orders->sum(function ($order) {
            return $order->price * $order->quantity;
        });

        return view('orders.index', compact('orders', 'totalAmount'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_order' => 'required',
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
        ]);

        $productId = $validatedData['id_order'];
        $productName = $validatedData['name'];
        $productPrice = $validatedData['price'];
        $quantity = $validatedData['quantity'];

        // calculate total price of order
        $total = $productPrice * $quantity;

        $order = new Order();

        $orders = Order::all();
        // var_dump($orders);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);

        return view('orders.show', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->id_order = $request->input('id_order');
        $order->name = $request->input('name');
        $order->price = $request->input('price');
        $order->quantity = $request->input('quantity');
        $order->total = $request->input('total');
        $order->save();

        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        dd($order);

        if ($order) {
            $order->delete();
        }

        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function addToCart(Request $request)
    {
        $order = new Order();
        $order->id_order = $request->input('id_order');
        $order->name = $request->input('name');
        $order->price = $request->input('price');
        $order->quantity = $request->input('quantity');
        $order->total = $order->price * $order->quantity;
        $order->save();

        $cartCount = Order::count();
        // dd($request->all());

        return response()->json(['cartCount' => $cartCount]);
    }

   public function card(Request $request)
   {
       $validatedData = $request->validate([
           'user_id' => 'required|integer',
           'cardholder_name' => 'required|string',
           'card_number' => 'required|string',
           'expiration_date' => 'required|string',
           'cvv' => 'required|string',
       ]);

       // Crearea unui nou obiect Card cu datele primite de la formular
       $card = new Card([
           'user_id' => $validatedData['user_id'],
           'card_holder' => $validatedData['cardholder_name'],
           'card_number' => $validatedData['card_number'],
           'expiration_month' => substr($validatedData['expiration_date'], 0, 2),
           'expiration_year' => substr($validatedData['expiration_date'], -2),
           'cvv' => $validatedData['cvv'],
       ]);

       // Salvarea obiectului Card în baza de date
       $card->save();
       dd($request->all());

       // Redirecționarea către o pagină de confirmare sau alte acțiuni
       return view('orders.card', [
        'card' => $card,
    ]);
   }
}
