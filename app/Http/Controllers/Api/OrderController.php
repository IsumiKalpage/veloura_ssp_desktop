<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MongoOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 🔹 List Orders (for logged-in user)
    public function index(Request $request)
    {
        $orders = MongoOrder::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($orders);
    }

    // 🔹 Single Order
    public function show(Request $request, $id)
    {
        $order = MongoOrder::where('user_id', $request->user()->id)->findOrFail($id);
        return response()->json($order);
    }

    // 🔹 Create Order
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => ['required','string'],
            'email'  => ['required','email'],
            'phone'  => ['required','string'],

            'shipping_address' => ['required','string'],
            'shipping_city'    => ['required','string'],
            'shipping_district'=> ['required','string'],
            'shipping_postal'  => ['required','string'],

            'payment_method'   => ['required','string'],

            'items'            => ['required','array','min:1'],
            'items.*.id'       => ['required'],
            'items.*.name'     => ['required','string'],
            'items.*.price'    => ['required','numeric'],
            'items.*.quantity' => ['required','integer','min:1'],

            'notes'            => ['nullable','string'],
            'billing_address'  => ['nullable','string'],
            'billing_city'     => ['nullable','string'],
            'billing_district' => ['nullable','string'],
            'billing_postal'   => ['nullable','string'],
        ]);

        // ✅ Calculate totals on server
        $subtotal = collect($data['items'])->sum(fn($i) => $i['price'] * $i['quantity']);
        $shipping = 350;
        $tax      = 100;
        $total    = $subtotal + $shipping + $tax;

        $order = MongoOrder::create([
            'user_id' => $request->user()->id,
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'] ?? null,

            'shipping_address' => $data['shipping_address'],
            'shipping_city'    => $data['shipping_city'],
            'shipping_district'=> $data['shipping_district'],
            'shipping_postal'  => $data['shipping_postal'],

            'billing_address'  => $data['billing_address'] ?? null,
            'billing_city'     => $data['billing_city'] ?? null,
            'billing_district' => $data['billing_district'] ?? null,
            'billing_postal'   => $data['billing_postal'] ?? null,

            'payment_method'   => $data['payment_method'],
            'notes'            => $data['notes'] ?? null,
            'items'            => $data['items'],

            // ✅ trusted server-side totals
            'subtotal'         => $subtotal,
            'shipping'         => $shipping,
            'tax'              => $tax,
            'total'            => $total,

            'status'           => 'pending',
        ]);

        return response()->json($order, 201);
    }
}
