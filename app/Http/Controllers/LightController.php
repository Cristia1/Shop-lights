<?php

namespace App\Http\Controllers;

use App\Models\Light;
use Illuminate\Http\Request;

class LightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lights = Light::latest()->paginate(5);
        $lights = Light::select('id', 'image', 'name', 'years', 'details', 'price')->get();
        // dd($lights);

        return view('lights.index', compact('lights'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name' => 'required',
            'years' => 'required',
            'details' => 'required',
            'price' => 'required',
        ]);

        Light::create($request->all());

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $light['image'] = "$profileImage";
        }
        Light::create($light);

        return redirect()->route('lights.index')->with('success', 'Light has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\light $Lights
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Light $light)
    {
        return view('lights.show', compact('light'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Light $lights
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Light $light)
    {
        // dd($light);

        return view('lights.edit', compact('light'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\light
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Light $light)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'price' => 'required',
            'years' => 'required',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }

        $light->update($input);
        // dd($light);

        return redirect()->route('lights.index')->with('success', 'Light Has Been updated successfully');
    }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Light $lights
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Light $light)
        {
            $light->delete();
            // dd($light);

            return redirect()->route('lights.index')->with('success', 'Light has been deleted successfully');
        }

    public function search()
    {
        $search_text = isset($_GET['query']) ? $_GET['query'] : '';

        $lights = Light::where('name', 'LIKE', '%'.$search_text.'%')
            ->orWhere('years', 'LIKE', '%'.$search_text.'%')
            ->orWhere('details', 'LIKE', '%'.$search_text.'%')
            ->orWhere('price', 'LIKE', '%'.$search_text.'%')
            ->get();
        // dd($lights);

        return view('lights.search', compact('lights'));
    }

    public function about()
    {
        return view('lights.about');
    }

    public function home()
    {
        // $lights = Light::all();
        return view('home');
    }

    public function shop()
    {
        $lights = Light::all();

        return view('shop.shop', ['lights' => $lights]);
    }

    public function bag($id)
    {
        $light = Light::findOrFail($id);

        return view('shop.bag', compact('light'));
    }
}
