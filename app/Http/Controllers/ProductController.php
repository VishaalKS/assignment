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
        $products = Product::get();
        return view('Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric'
        ]);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => 'https://placehold.co/400',
            'description' => $request->description
        ]);

        return response()->redirectToRoute('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('Product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }


    public function addToCart()
    {
        $cart_item = $_COOKIE['cart_item'] ?? 0;
        $cart_item++;
        $cookie = cookie('cart_item', $cart_item, 43200);

        return response()->json(['message' => 'Item added to cart successfully'])->cookie($cookie);
    }
}
