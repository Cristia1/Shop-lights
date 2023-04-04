<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();

        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => [
                'image' => $product->image,
                'details' => $product->details,
            ],
        ]);

        return response()->json(['success' => true]);
    }

    public function removeFromCart(Request $request)
    {
        $rowId = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        })->first();

        if ($rowId !== null) {
            Cart::remove($rowId);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
