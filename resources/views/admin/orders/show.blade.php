<x-app-layout>
    <div class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false }">
        {{-- Topbar --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100">
            <div class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <!-- Hamburger -->
                        <button class="md:hidden p-2 text-gray-600" @click="sidebarOpen = true">
                            <img src="{{ asset('images/hamb.png') }}" class="h-6 w-6" alt="Menu">
                        </button>
                        <img src="{{ asset('images/logo.png') }}" class="h-8">
                    </div>
                    <div class="relative group">
                        <a href="{{ route('admin.profile') }}"><img src="{{ asset('images/profile.png') }}" class="h-6 w-6 rounded-full ring-2 ring-white cursor-pointer"></a>
                        <div class="absolute left-1/2 -translate-x-1/2 mt-2 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Admin</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-6xl mx-auto px-6 lg:px-12 py-10 space-y-8">
            {{-- Back Button --}}
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-sm font-medium text-rose-700 hover:text-rose-900">← Back to Orders</a>

            {{-- Top Cards --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Order Info --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold">Order #{{ $order->_id }}</h2>
                        <span class="px-3 py-1 text-xs rounded-full
                            @if($order->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($order->status === 'completed') bg-green-100 text-green-700
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-700 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                        <div class="space-y-2">
                            <p><span class="text-gray-500">Customer:</span> <span class="font-medium">{{ $order->name }}</span></p>
                            <p><span class="text-gray-500">Email:</span> {{ $order->email }}</p>
                            <p><span class="text-gray-500">Phone:</span> {{ $order->phone }}</p>
                        </div>
                        <div class="space-y-2">
                            <p><span class="text-gray-500">Placed:</span> {{ $order->created_at?->format('M d, Y h:i A') }}</p>
                            <p><span class="text-gray-500">Payment:</span>
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">{{ ucfirst($order->payment_method) }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="bg-white rounded-2xl shadow-md border p-6 space-y-4">
                    <h3 class="text-lg font-semibold">Summary</h3>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between"><span class="text-gray-600">Subtotal</span><span>Rs. {{ number_format($order->subtotal, 2) }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Shipping</span><span>Rs. {{ number_format($order->shipping, 2) }}</span></div>
                        <div class="flex justify-between"><span class="text-gray-600">Tax</span><span>Rs. {{ number_format($order->tax, 2) }}</span></div>
                        <hr>
                        <div class="flex justify-between text-base font-bold"><span>Total</span><span class="text-rose-700">Rs. {{ number_format($order->total, 2) }}</span></div>
                    </div>
                    <div class="pt-4 space-y-3 text-sm">
                        <div><h4 class="font-semibold">Shipping Address</h4><p>{{ $order->shipping_address ?? '-' }}, {{ $order->shipping_city ?? '-' }}, {{ $order->shipping_district ?? '-' }}, {{ $order->shipping_postal ?? '-' }}</p></div>
                        <div><h4 class="font-semibold">Billing Address</h4><p>{{ $order->billing_address ?? '-' }}, {{ $order->billing_city ?? '-' }}, {{ $order->billing_district ?? '-' }}, {{ $order->billing_postal ?? '-' }}</p></div>
                    </div>
                </div>
            </div>

            {{-- Products Table --}}
            <div class="bg-white rounded-2xl shadow-md border p-6">
                <h3 class="text-lg font-semibold mb-4">Ordered Products</h3>
                <div class="overflow-x-auto rounded-lg border">
                    <table class="min-w-full text-sm">
                        <thead class="bg-rose-50 text-rose-900 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3 text-left">Product</th>
                                <th class="px-4 py-3 text-left">Brand</th>
                                <th class="px-4 py-3 text-left">Category</th>
                                <th class="px-4 py-3 text-center">Qty</th>
                                <th class="px-4 py-3 text-right">Price</th>
                                <th class="px-4 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($order->items as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 flex items-center gap-3">
                                        @if(!empty($item['image']))
                                            <img src="{{ asset('storage/'.$item['image']) }}" class="w-10 h-10 rounded-lg object-cover border">
                                        @else
                                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">?</div>
                                        @endif
                                        <span>{{ $item['name'] ?? '-' }}</span>
                                    </td>
                                    <td class="px-4 py-3">{{ $item['brand'] ?? '-' }}</td>
                                    <td class="px-4 py-3 capitalize">{{ $item['category'] ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item['quantity'] ?? 0 }}</td>
                                    <td class="px-4 py-3 text-right">Rs. {{ number_format($item['price'] ?? 0, 2) }}</td>
                                    <td class="px-4 py-3 text-right font-semibold">Rs. {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0), 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
