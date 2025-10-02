<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 🔹 List Products (JSON for mobile)
    public function index(Request $request)
    {
        $query = Product::query();

        // Category filter (ignore if "all")
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Rating filter
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // Price range filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // ✅ Paginate
        $products = $query->latest()->paginate(12)->appends($request->all());

        // ✅ Map image paths → full URLs
        $products->getCollection()->transform(function ($product) {
            $product->image_url = $product->image_path
                ? asset('storage/' . $product->image_path)
                : null;

            $product->image_url2 = $product->image_path2
                ? asset('storage/' . $product->image_path2)
                : null;

            return $product;
        });

        return response()->json($products);
    }

    // 🔹 Product Details (JSON for mobile)
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // ✅ Add full image URLs
        $product->image_url = $product->image_path
            ? asset('storage/' . $product->image_path)
            : null;

        $product->image_url2 = $product->image_path2
            ? asset('storage/' . $product->image_path2)
            : null;

        return response()->json($product);
    }
}
