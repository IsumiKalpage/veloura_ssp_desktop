<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MongoOrder;
use App\Models\Product;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping = 350;
        $tax = 100;
        $total = $subtotal + $shipping + $tax;

        return view('customer.checkout', compact('cart', 'subtotal', 'shipping', 'tax', 'total'));
    }

    // Store order
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        // 🛑 Check stock availability before saving order
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            if (!$product || $product->stock < $item['quantity']) {
                return back()->with('error', "Not enough stock for {$item['name']}.");
            }
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $shipping = 350;
        $tax = 100;
        $total = $subtotal + $shipping + $tax;

        // ✅ Save order to MongoDB
        $order = MongoOrder::create([
            'user_id'   => auth()->id(),
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'shipping_address' => $request->address,
            'shipping_city'    => $request->city,
            'shipping_district'=> $request->district,
            'shipping_postal'  => $request->postal_code,
            'billing_address'  => $request->billing_address ?? $request->address,
            'billing_city'     => $request->billing_city ?? $request->city,
            'billing_district' => $request->billing_district ?? $request->district,
            'billing_postal'   => $request->billing_postal_code ?? $request->postal_code,
            'payment_method'   => $request->payment_method,
            'notes'            => $request->notes,
            'items'            => $cart,
            'subtotal'         => $subtotal,
            'shipping'         => $shipping,
            'tax'              => $tax,
            'total'            => $total,
            'status'           => 'pending',
        ]);

        // 🔻 Deduct stock from MySQL products
        foreach ($cart as $id => $item) {
            Product::where('id', $id)->decrement('stock', $item['quantity']);
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to confirmation
        return redirect()->route('checkout.confirmation', ['id' => $order->_id]);
    }

    public function confirmation($id)
    {
        $order = MongoOrder::findOrFail($id);
        return view('customer.confirmation', compact('order'));
    }
}
