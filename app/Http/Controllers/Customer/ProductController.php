<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Shop All
    public function index(Request $request)
    {
        $query = Product::query();

        // Handle search query
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                ->orWhere('brand', 'like', "%{$searchTerm}%");
            });
        }

        //  Category filter
        if ($request->category) {
            $query->where('category', $request->category);
        }

        // Brand filter
        if ($request->brand) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Rating filter
        if ($request->rating) {
            $query->where('rating', '>=', $request->rating);
        }

        // Price filter
        if ($request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->paginate(12);

        return view('customer.shop', compact('products'));
    }


    // Product Details
    public function show(Product $product)
    {
        return view('customer.product-details', compact('product'));
    }

    //  Skincare only
    public function skincare(Request $request)
    {
        $query = Product::where('category', 'skincare');

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(12)->appends($request->all());

        return view('customer.skincare', compact('products'));
    }

    //  Haircare only
    public function haircare(Request $request)
    {
        $query = Product::where('category', 'haircare');

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(12)->appends($request->all());

        return view('customer.haircare', compact('products'));
    }

    //  Cosmetics only
    public function cosmetics(Request $request)
    {
        $query = Product::where('category', 'cosmetics');

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->latest()->paginate(12)->appends($request->all());

        return view('customer.cosmetics', compact('products'));
    }
}
