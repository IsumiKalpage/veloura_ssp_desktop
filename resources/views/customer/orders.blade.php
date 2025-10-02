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

    <div class="max-w-6xl mx-auto px-6 lg:px-12 py-12 space-y-8">
        <h1 class="text-3xl font-bold text-rose-800 mb-6">My Orders</h1>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded-xl border p-6 hover:shadow-lg transition">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            {{-- Order Info --}}
                            <div>
                                <p class="font-semibold text-gray-800">
                                    Order <span class="text-rose-700">#{{ $order->_id }}</span>
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $order->created_at->format('M d, Y - h:i A') }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium text-gray-600">Total:</span> 
                                    <span class="text-rose-700 font-bold">Rs. {{ number_format($order->total, 2) }}</span>
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium text-gray-600">Status:</span>
                                    @if($order->status === 'pending')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                            Pending
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                            Completed
                                        </span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                            Cancelled
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    @endif
                                </p>
                            </div>

                            {{-- View Details Button --}}
                            <div class="w-full md:w-auto">
                                <a href="{{ route('orders.show', $order->_id) }}"
                                   class="block w-full text-center px-4 py-2 bg-rose-700 text-white rounded-lg hover:bg-rose-800 transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white shadow-md rounded-xl border p-8 text-center">
                <p class="text-gray-600">You don’t have any orders yet.</p>
                <a href="{{ url('/shop') }}" 
                   class="mt-4 inline-block px-6 py-3 bg-rose-700 text-white rounded-lg hover:bg-rose-800 transition">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
