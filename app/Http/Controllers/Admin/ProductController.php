<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔎 Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 📂 Category filter
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 🏷️ Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 📦 Stock filter
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'in_stock') {
                $query->where('stock', '>', 5);
            } elseif ($request->stock_status === 'low_stock') {
                $query->whereBetween('stock', [1, 5]);
            } elseif ($request->stock_status === 'out_of_stock') {
                $query->where('stock', 0);
            }
        }

        // 🏭 Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // ⭐ Rating filter
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // 💸 Discount filter
        if ($request->filled('discount')) {
            if ($request->discount === 'with') {
                $query->whereNotNull('discount')->where('discount', '>', 0);
            } elseif ($request->discount === 'without') {
                $query->where(function ($q) {
                    $q->whereNull('discount')->orWhere('discount', 0);
                });
            }
        }

        // ✅ Run query
        $products = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ['skincare', 'haircare', 'cosmetics'];
        $statuses   = ['active', 'draft'];
        return view('admin.products.create', compact('categories', 'statuses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'brand'       => ['nullable', 'string', 'max:255'],
            'rating'      => ['required', 'integer', 'min:0', 'max:5'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category'    => ['required', Rule::in(['skincare', 'haircare', 'cosmetics'])],
            'stock'       => ['required', 'integer', 'min:0'],
            'status'      => ['required', Rule::in(['active', 'draft'])],
            'discount'    => ['nullable','numeric','min:0','max:100'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image2'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('image2')) {
            $data['image_path2'] = $request->file('image2')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = ['skincare', 'haircare', 'cosmetics'];
        $statuses   = ['active', 'draft'];
        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'brand'       => ['nullable', 'string', 'max:255'],
            'rating'      => ['required', 'integer', 'min:0', 'max:5'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category'    => ['required', Rule::in(['skincare', 'haircare', 'cosmetics'])],
            'stock'       => ['required', 'integer', 'min:0'],
            'status'      => ['required', Rule::in(['active', 'draft'])],
            'discount'    => ['nullable','numeric','min:0','max:100'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image2'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('image2')) {
            if ($product->image_path2) {
                Storage::disk('public')->delete($product->image_path2);
            }
            $data['image_path2'] = $request->file('image2')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        if ($product->image_path2) {
            Storage::disk('public')->delete($product->image_path2);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted.');
    }
}
