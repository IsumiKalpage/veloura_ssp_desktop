<?php

// app/Http/Controllers/Customer/OrderController.php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\MongoOrder;

class OrderController extends Controller
{
    public function index()
    {
        $orders = MongoOrder::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = MongoOrder::where('user_id', auth()->id())->findOrFail($id);

        return view('customer.confirmation', compact('order')); 
        // reusing confirmation view for individual order
    }
}
