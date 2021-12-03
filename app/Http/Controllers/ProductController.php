<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function files()
    {
        // return Inertia::render('Images');
        return Inertia::render('Files');
    }
    public function saveFile(Request $r)
    {

        $data['file']=$r->file('file')->store('uploads', 'public');
        return response()->json([
            'status' =>200,
        ]);;
    }
    
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Show', ['products'=>$products]);
    }

    public function create()
    {
        return Inertia::render('FormCreate');
    }

    public function store(Request $request)
    {
         $request->validate([
            'description' => 'required',
            'price' => 'required'
         ]);
         Product::create(request()->all());
         return Redirect::route('products.index');
    }


    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return Inertia::render('FormEdit',  ['data'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update(request()->all());
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return Redirect::route('products.index');
    }
}
