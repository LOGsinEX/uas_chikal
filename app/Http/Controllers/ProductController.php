<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'required|max:255',
    
            'category_id' => 'required|exists:categories,id',
    
            'price' => 'required|numeric',
    
            'description' => 'required',
    
        ]);
    
    
        $product = Product::create($validatedData);
    
    
        return redirect()->route('products.index')->with('status', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([

            'name' => 'required|max:255',
    
            'category_id' => 'required|exists:categories,id',
    
            'price' => 'required|numeric',
    
            'description' => 'required',
    
        ]);
    
    
        $product->update($validatedData);
    
    
        return redirect()->route('products.index')->with('status', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product->delete();


    return redirect()->route('products.index')->with('status', 'Product deleted successfully.');
    }
}
