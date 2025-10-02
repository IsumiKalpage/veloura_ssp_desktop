<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart', compact('cart'));
    }

    // Add product to cart
    public function add(Request $request, Product $product)
    {
        // 🛑 Prevent adding if stock is 0
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'This product is out of stock.');
        }

        $cart = session()->get('cart', []);

        // ✅ If product has discount, apply it
        $price = $product->price;
        if ($product->discount > 0) {
            $price = $product->price - ($product->price * ($product->discount / 100));
        }

        if (isset($cart[$product->id])) {
            // 🛑 Prevent exceeding stock
            if ($cart[$product->id]['quantity'] + 1 > $product->stock) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name'     => $product->name,
                'brand'    => $product->brand,
                'category' => $product->category,   // ✅ always pull from DB column
                'price'    => $price,
                'image'    => $product->image_path,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Update quantity
    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $quantity = (int) $request->quantity;

            // 🛑 Prevent exceeding stock
            if ($quantity > $product->stock) {
                return back()->with('error', 'Not enough stock available.');
            }

            $cart[$product->id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return back();
    }

    // Remove product
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Product removed.');
    }
}
