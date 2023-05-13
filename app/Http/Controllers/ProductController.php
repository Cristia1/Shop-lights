<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
