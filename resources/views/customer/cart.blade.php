<x-app-layout>
    {{-- Shipping Banner --}}
    <div class="bg-gradient-to-r from-rose-100 to-pink-100 border-b border-rose-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center text-sm py-2 text-rose-900 font-medium">
                Shipping done all across the country!
            </div>
        </div>
    </div>

    <x-navbar />

    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10 grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-8">
        
        {{-- Cart Items --}}
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Welcome to your Shopping Cart</h2>

            @php $subtotal = 0; @endphp

            @if(count($cart) > 0)
                {{-- Desktop Table --}}
                <div class="hidden md:block">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="pb-3">Product</th>
                                <th class="pb-3 text-center">Quantity</th>
                                <th class="pb-3 text-right">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                                @php 
                                    $lineTotal = $item['price'] * $item['quantity']; 
                                    $subtotal += $lineTotal; 
                                @endphp
                                <tr class="border-b">
                                    <td class="py-4 flex items-center gap-4">
                                        <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : asset('images/placeholder-product.png') }}"
                                            class="h-16 w-16 object-cover rounded">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $item['name'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $item['brand'] }}</p>
                                        </div>
                                    </td>

                                    {{-- Quantity --}}
                                    <td class="py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                                <button type="submit" class="px-2 py-1 border rounded">-</button>
                                            </form>

                                            <span>{{ $item['quantity'] }}</span>

                                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                                <button type="submit" class="px-2 py-1 border rounded">+</button>
                                            </form>
                                        </div>
                                    </td>

                                    {{-- Price + Delete --}}
                                    <td class="py-4">
                                        <div class="flex items-center justify-end gap-4">
                                            <span class="text-gray-800 font-medium">
                                                Rs. {{ number_format($lineTotal, 2) }}
                                            </span>
                                            <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                                @csrf
                                                <button type="submit" class="text-red-600 text-xl hover:text-red-800 flex items-center justify-center">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Mobile Card View --}}
                <div class="space-y-4 md:hidden">
                    @foreach($cart as $id => $item)
                        @php 
                            $lineTotal = $item['price'] * $item['quantity']; 
                            $subtotal += $lineTotal; 
                        @endphp
                        <div class="border rounded-lg p-4 flex flex-col gap-3">
                            <div class="flex items-center gap-4">
                                <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : asset('images/placeholder-product.png') }}"
                                    class="h-16 w-16 object-cover rounded">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $item['brand'] }}</p>
                                </div>
                            </div>

                            {{-- Quantity --}}
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Quantity:</span>
                                <div class="flex items-center gap-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                        <button type="submit" class="px-2 py-1 border rounded">-</button>
                                    </form>
                                    <span>{{ $item['quantity'] }}</span>
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                        <button type="submit" class="px-2 py-1 border rounded">+</button>
                                    </form>
                                </div>
                            </div>

                            {{-- Price + Delete --}}
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-800">Rs. {{ number_format($lineTotal, 2) }}</span>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                    @csrf
                                    <button type="submit" class="text-red-600 text-xl hover:text-red-800 flex items-center justify-center">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">Your cart is empty.</p>
            @endif
        </div>

        {{-- Order Summary --}}
        <div class="bg-white rounded-xl shadow-sm border p-6 h-fit">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Order Summary</h2>

            @php 
                $shipping = 350; 
                $tax = 100; 
                $total = $subtotal + $shipping + $tax; 
            @endphp

            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="text-gray-800">Rs. {{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Shipping</span>
                    <span class="text-gray-800">Rs. {{ number_format($shipping, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tax</span>
                    <span class="text-gray-800">Rs. {{ number_format($tax, 2) }}</span>
                </div>
                <hr>
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span class="text-gray-900">Rs. {{ number_format($total, 2) }}</span>
                </div>
            </div>

            @if(count($cart) > 0)
                <a href="{{ route('checkout.index') }}" 
                   class="mt-6 w-full block text-center py-3 bg-rose-700 text-white rounded-lg hover:bg-rose-800 transition">
                    Checkout
                </a>
            @else
                <button disabled
                        class="mt-6 w-full py-3 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed">
                    Checkout
                </button>
            @endif

            <a href="{{ route('orders.index') }}" 
               class="mt-3 w-full block text-center py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                View My Past Orders
            </a>
        </div>
    </div>
</x-app-layout>

<x-footer />
