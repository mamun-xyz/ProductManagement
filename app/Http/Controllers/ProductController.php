<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('product_id', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'asc');

        $products = $query->orderBy($sortBy, $sortOrder)->paginate(10);

        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|unique:products',
            'name' => 'required',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $validated['image'] = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create($validated);

        return redirect()->route('products.index');
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required|unique:products,product_id,' . $id,
            'name' => 'required',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
            if ($product->image) {
                unlink(storage_path('app/public/' . $product->image));
            }
        }

        $product->update($validated);

        return redirect()->route('products.index');
    }

    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            unlink(storage_path('app/public/' . $product->image));
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}
