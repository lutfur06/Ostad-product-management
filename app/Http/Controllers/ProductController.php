<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sortBy = $request->get('sort_by', 'id') ;// Default sort by 'name'
        $sortOrder = $request->get('sort_order', 'desc');
        $products = Product::orderBy($sortBy, $sortOrder)->paginate(5);
        return view('products.index', compact('products','sortBy', 'sortOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price' => ['required', 'numeric'],
        'stock' => ['nullable', 'integer'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        'product_id' => ['required', 'string', 'unique:products,product_id'],

    ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_id = $request->product_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $product->image = $image_name;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }catch(Exception $e){
        return redirect()->route('products.index')->with('error', $e->getMessage());
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric'],
            'stock' => ['nullable', 'integer'],
            'product_id' => ['required', 'string', 'unique:products,product_id'.$id],
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->product_id = $request->product_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (File::exists('images/' . $product->image)) {
                File::delete('images/' . $product->image);
            }
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
            $product->image = $image_name;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        File::delete('images/' . $product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->get('sort_by', 'id'); // Default sort by 'name'
        $sortOrder = $request->get('sort_order', 'asc');
        $products = Product::where('product_id', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->orderBy($sortBy, $sortOrder)
            ->paginate(5);
    if($products->isEmpty()){
        return abort('404');
    }
        return view('products.index', compact('products', 'sortBy', 'sortOrder'));
    }

}
