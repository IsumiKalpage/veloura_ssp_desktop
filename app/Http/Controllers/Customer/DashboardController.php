<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Latest 5 products
        $latestProducts = Product::latest()->take(5)->get();

        // Latest 5 discounted products
        $discountedProducts = Product::whereNotNull('discount')
            ->where('discount', '>', 0)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('latestProducts', 'discountedProducts'));
    }
}
