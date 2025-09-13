<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Show all products
    public function index(Request $request)
    {
        $search = $request->Get('search');
        $Products = Product::when($search, function($query, $search){
            return $query->where('name', 'like', "%{$search}%");
        })->get();
        return view('products.index', compact('Products','search'));
    }
    //Create a product
    public function create()
    {
        return view('products.create');
    }

    //Save a created product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    //Delete a Product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    //Return the edit form view
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    //Update the Entry
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }
    //Set & Implement the homepage with product and quantity
    public function home(){
        $products = Product::select('name','quantity')
                    ->where('status', 1) // Only get active products
                    ->get();
        return view('home', compact('products'));
    }
}
