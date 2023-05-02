<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable',
            'name' => 'required',
            'brand' => 'required',
            'wattage' => 'required',
            'price' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }

        Product::create($input);

        return redirect()->route('products.index')->with('success', 'Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\light $Lights
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Light $lights
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\light
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'nullable|image|',
            'name' => 'required',

            'brand' => 'required',
            'wattage' => 'required',
            'price' => 'required',
            'descriptions' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $product->update($input);
        // dd($light);

        return redirect()->route('products.index')->with('success', 'Product Has Been updated successfully');
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Products $products
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Product $product)
        {
            $product->delete();
            // dd($light);

            return redirect()->route('products.index')->with('success', 'Product has been deleted successfully');
        }

        public function home()
        {
            // Make conection with model and get all;
            $products = Product::all();

            return view('home')->with('products', $products);
        }

        public function search()
        {
            $search_all = request('query');

            $products = Product::where('name', 'LIKE', '%'.$search_all.'%')
                                ->orWhere('brand', 'LIKE', '%'.$search_all.'%')
                                ->orWhere('wattage', 'LIKE', '%'.$search_all.'%')
                                ->orWhere('price', 'LIKE', '%'.$search_all.'%')
                                ->get();

            return view('products.search', compact('products'));
        }

        public function about()
        {
            return view('products.about');
        }

        public function shop()
        {
            $products = Product::all();

            return view('shop.shop', ['products' => $products]);
        }

        public function bag($id)
        {
            $product = Product::findOrFail($id);

            return view('shop.bag', compact('product'));
        }

        public function addToCart(Request $request, $id)
        {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['error' => 'Product not found!'], 404);
            }

            $orders = Order::where('user_id', Auth::id())->get();

            if ($orders->isEmpty()) {
                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->save();
            } else {
                $cart = $orders[0]->cart;
            }

            $item = CartItem::where('cart_id', $cart->id)->where('product_id', $product->id)->first();

            if ($item) {
                ++$item->quantity;
                $item->name = $product->name;
                $item->price = $product->price;
                $item->total = $item->quantity * $item->price;
                $item->save();
            } else {
                $item = new CartItem();
                $item->cart_id = $cart->id;
                $item->product_id = $product->id;
                $item->quantity = 1;
                $item->name = $product->name;
                $item->price = $product->price;
                $item->total = $item->quantity * $item->price;
                $item->save();
            }

            return response()->json(['success' => 'Product added to cart!'], 200);
        }

        public function card(Request $request)
        {
            if (!Route::has('payment')) {
                dd('Ruta "payment" nu este definită în fișierul web.php.');
            }
            // Validează datele primite din formular
            $validatedData = $request->validate([
                'card_number' => 'required|numeric|digits:16',
                'card_holder' => 'required|string',
                'expiration_month' => 'required|numeric|digits:2|between:1,12',
                'expiration_year' => 'required|numeric|digits:4|after:today',
                'cvv' => 'required|numeric|digits:3',
            ]);

            // Creează un nou obiect Card cu datele plății
            $card = new Card([
                'card_number' => $request->input('card_number'),
                'card_holder' => $request->input('card_holder'),
                'expiration_month' => $request->input('expiration_month'),
                'expiration_year' => $request->input('expiration_year'),
                'cvv' => $request->input('cvv'),
            ]);

            // Salvează obiectul Card în baza de date
            $card->save();

            return view('products.payment');
        }
}
