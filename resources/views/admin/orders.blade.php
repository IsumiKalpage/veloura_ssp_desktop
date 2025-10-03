<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-[1400px] mx-auto px-6 lg:px-8 space-y-8">

            <!-- Page Title -->
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Manage Orders</h1>
            </div>

            <!-- Filters -->
            <div class="bg-white shadow-sm border rounded-xl p-6">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="col-span-2">
                        <input type="text" name="search" placeholder="Search by order ID, customer, email"
                               value="{{ request('search') }}"
                               class="w-full rounded-lg border-gray-300 focus:ring-rose-500 focus:border-rose-500 text-sm px-4 py-2">
                    </div>

                    <!-- Status -->
                    <div>
                        <select name="status"
                                class="w-full rounded-lg border-gray-300 focus:ring-rose-500 focus:border-rose-500 text-sm px-4 py-2">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="out-for-delivery" {{ request('status') == 'out-for-delivery' ? 'selected' : '' }}>Out for Delivery</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                                class="flex-1 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                            Apply Filters
                        </button>
                        <a href="{{ route('admin.orders.index') }}"
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Orders Table -->
            <div class="bg-white shadow-sm border rounded-xl overflow-x-auto">
                <table class="min-w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-rose-50 text-rose-900 text-xs uppercase tracking-wide">
                            <th class="px-4 py-3 text-left">Order #</th>
                            <th class="px-4 py-3 text-left">Customer</th>
                            <th class="px-4 py-3 text-center">Items</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3 text-left">Payment</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Order ID -->
                                <td class="px-4 py-3 font-medium text-gray-800">
                                    {{ $order->_id }}
                                </td>

                                <!-- Customer -->
                                <td class="px-4 py-3 text-gray-700">
                                    <div class="font-semibold">{{ $order->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->email }}</div>
                                </td>

                                <!-- Items -->
                                <td class="px-4 py-3 text-center text-gray-600">
                                    {{ count($order->items) }}
                                </td>

                                <!-- Total -->
                                <td class="px-4 py-3 text-right font-semibold text-rose-600">
                                    Rs. {{ number_format($order->total, 2) }}
                                </td>

                                <!-- Payment -->
                                <td class="px-4 py-3 text-gray-600">
                                    {{ ucfirst($order->payment_method) }}
                                </td>

                                <!-- Status -->
                                <td class="px-4 py-3 text-center">
                                    @if($order->status === 'pending')
                                        <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($order->status === 'processing')
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Processing</span>
                                    @elseif($order->status === 'out-for-delivery')
                                        <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800">Out for Delivery</span>
                                    @elseif($order->status === 'completed')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelled</span>
                                    @endif
                                </td>

                                <!-- Date -->
                                <td class="px-4 py-3 text-gray-500">
                                    {{ $order->created_at ? $order->created_at->format('M d, Y H:i') : '-' }}
                                </td>

                                <!-- Actions -->
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('admin.orders.show', $order->_id) }}"
                                       class="px-3 py-1 text-xs font-medium rounded-lg border bg-white hover:bg-gray-50 text-gray-700">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
