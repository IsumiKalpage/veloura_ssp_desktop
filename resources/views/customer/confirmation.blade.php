<x-app-layout>
    {{-- Shipping Banner --}}
        <div class="bg-gradient-to-r from-rose-100 to-pink-100 border-b border-rose-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center text-sm py-2 text-rose-900 font-medium">
                    Shipping done all across the country!
                </div>
            </div>
        </div>

        {{-- Curved Elevated Navbar --}}
        <x-navbar />
    <div class="max-w-6xl mx-auto px-6 lg:px-12 py-12 space-y-10">
        

        {{-- Thank You Banner --}}
        <div class="bg-gradient-to-r from-rose-100 to-pink-100 rounded-2xl shadow p-8 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-rose-800 mb-3">🎉 Thank You for Your Order!</h1>
            <p class="text-gray-700 text-sm md:text-base">
                Your order <span class="font-semibold text-rose-700">#{{ $order->_id }}</span> has been placed successfully.
            </p>
        </div>

        {{-- Order Summary Card --}}
        <div class="bg-white shadow-md rounded-2xl border p-6 md:p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Order Summary</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div class="space-y-2">
                    <p><span class="font-medium text-gray-600">Order Date:</span> {{ $order->created_at->format('M d, Y - h:i A') }}</p>
                    <p><span class="font-medium text-gray-600">Payment Method:</span> {{ ucfirst($order->payment_method) }}</p>
                    <p><span class="font-medium text-gray-600">Status:</span> 
                        <span class="px-2 py-1 text-xs rounded-full 
                            {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
                <div class="space-y-2">
                    <p><span class="font-medium text-gray-600">Total:</span> 
                        <span class="text-rose-700 font-bold">Rs. {{ number_format($order->total, 2) }}</span>
                    </p>
                    <p><span class="font-medium text-gray-600">Shipping Address:</span> 
                        {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_district }}, {{ $order->shipping_postal }}
                    </p>
                    <p><span class="font-medium text-gray-600">Billing Address:</span> 
                        {{ $order->billing_address }}, {{ $order->billing_city }}, {{ $order->billing_district }}, {{ $order->billing_postal }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Ordered Products List --}}
        <div class="bg-white shadow-md rounded-2xl border p-6 md:p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Ordered Products</h2>

            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between border-b pb-4">
                        <div class="flex items-center gap-4">
                            <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : asset('images/placeholder-product.png') }}"
                                 class="w-16 h-16 object-cover rounded-lg border">
                            <div>
                                <p class="font-medium text-gray-900">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500">{{ $item['brand'] }} | {{ ucfirst($item['category']) }}</p>
                                <p class="text-xs text-yellow-500">Qty: {{ $item['quantity'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Rs. {{ number_format($item['price'], 2) }}</p>
                            <p class="text-sm font-semibold text-rose-700">Rs. {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="text-center space-x-4">
            <a href="{{ url('/shop') }}" 
               class="px-6 py-3 bg-rose-700 text-white rounded-lg hover:bg-rose-800 transition shadow">
                Continue Shopping
            </a>
            <a href="{{ url('/account/orders') }}" 
               class="px-6 py-3 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition shadow">
                View My Orders
            </a>
        </div>
    </div>
</x-app-layout>
