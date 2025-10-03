{{-- resources/views/admin/admindashboard.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false }">
        <!-- Topbar -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100">
            <div class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between">
                    
                    <!-- Left: Logo + Search -->
                    <div class="flex items-center gap-4 flex-1">
                        <!-- Mobile Sidebar Toggle -->
                        <button class="md:hidden p-2 text-gray-600" @click="sidebarOpen = true">
                            <img src="{{ asset('images/hamb.png') }}" alt="Menu" class="h-6 w-6">
                        </button>

                        <!-- Logo -->
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-8">
                        </div>

                        <!-- Search -->
                        <div class="flex-1 max-w-md ml-4 hidden sm:block">
                            <div class="relative">
                                <input type="text" placeholder="Search..."
                                    class="w-full h-10 pl-9 pr-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 text-sm" />
                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"
                                    viewBox="0 0 24 24" fill="none">
                                    <path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Profile -->
                    <div class="relative group">
                        <a href="{{ route('admin.profile') }}">
                            <img src="{{ asset('images/profile.png') }}" 
                                class="h-6 w-6 ring-white cursor-pointer">
                        </a>
                        <div class="absolute left-1/2 -translate-x-1/2 mt-2 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                            Admin
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8 py-6 flex gap-6">
            <!-- Sidebar Drawer for Mobile -->
            <div 
                class="fixed inset-0 z-40 md:hidden"
                x-show="sidebarOpen"
                x-transition:enter="transition-opacity ease-linear duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-black bg-opacity-40" @click="sidebarOpen = false"></div>

                <!-- Drawer -->
                <div 
                    class="absolute top-0 left-0 w-64 h-full bg-white shadow-xl p-5 transform transition-transform duration-300"
                    x-show="sidebarOpen"
                    x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full">
                    
                    <div class="flex items-center justify-between mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-8">
                        <button @click="sidebarOpen = false" class="text-gray-600">✕</button>
                    </div>

                    <nav class="flex flex-col gap-3 text-sm">
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold" href="#">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-box"></i> Products
                        </a>
                        <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-users"></i> Customers
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                        <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-envelope"></i> Messages
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100" href="#">
                            <i class="fas fa-chart-line"></i> Analytics
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100" href="#">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Desktop Sidebar -->
            <aside class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 p-3 w-56">
                <nav class="flex flex-col gap-1 text-sm">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold" href="#">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-box"></i> Products
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-users"></i> Customers
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <i class="fas fa-envelope"></i> Messages
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100" href="#">
                        <i class="fas fa-chart-line"></i> Analytics
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100" href="#">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <section class="flex-1 flex flex-col gap-6">
                {{-- Stat Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5 place-items-center">
                    <div class="w-full sm:w-[90%] md:w-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <p class="text-sm text-gray-500">Total Revenue</p>
                        <h3 class="text-2xl font-bold mt-1">
                            {{ number_format($totalRevenue >= 1000000 ? $totalRevenue/1000000 : ($totalRevenue >= 1000 ? $totalRevenue/1000 : $totalRevenue), 1) }}
                            {{ $totalRevenue >= 1000000 ? 'M' : ($totalRevenue >= 1000 ? 'K' : '') }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">From all completed orders</p>
                    </div>
                    <div class="w-full sm:w-[90%] md:w-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <p class="text-sm text-gray-500">Orders</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $totalOrders }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Total Orders Received</p>
                    </div>
                    <div class="w-full sm:w-[90%] md:w-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <p class="text-sm text-gray-500">Total Products</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $totalProducts }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Available Products</p>
                    </div>
                    <div class="w-full sm:w-[90%] md:w-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <p class="text-sm text-gray-500">Total Customers</p>
                        <h3 class="text-2xl font-bold mt-1">{{ $totalCustomers }}</h3>
                        <p class="text-xs text-gray-400 mt-1">Registered Users</p>
                    </div>
                </div>

                {{-- Charts --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 col-span-1 md:col-span-2">
                        <h3 class="font-semibold text-gray-800 mb-4">Sales Analytics (Last 7 Days)</h3>
                        <div class="h-64">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    {{-- Chart.js --}}
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('salesChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: @json($labels),
                                datasets: [{
                                    label: 'Sales (Rs.)',
                                    data: @json($data),
                                    backgroundColor: 'rgba(244, 63, 94, 0.7)',
                                    borderRadius: 6,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value) {
                                                if (value >= 1000000) return (value/1000000) + 'M';
                                                if (value >= 1000) return (value/1000) + 'K';
                                                return value;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    </script>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="font-semibold text-gray-800 mb-4">Customer Insights</h3>

                        <div class="h-64 flex items-center justify-center">
                            <canvas id="customerInsightsChart" class="w-full h-full"></canvas>
                        </div>
                    </div>

                    {{-- Chart.js for Customer Insights --}}
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const ctx = document.getElementById('customerInsightsChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Active Customers', 'Inactive Customers'],
                                    datasets: [{
                                        data: [{{ $activeCustomers }}, {{ $inactiveCustomers }}],
                                        backgroundColor: [
                                            'rgba(244, 63, 94, 0.8)',  // rose-600
                                            'rgba(229, 231, 235, 0.8)' // gray-200
                                        ],
                                        borderColor: [
                                            'rgba(244, 63, 94, 1)',
                                            'rgba(229, 231, 235, 1)'
                                        ],
                                        borderWidth: 2
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                            labels: {
                                                font: {
                                                    size: 14,
                                                    weight: '500'
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                </div>

                {{-- Tables --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Top Products -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="font-semibold text-gray-800 mb-4">Top Products</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full border-collapse text-sm">
                                <thead class="bg-rose-50 text-rose-900 text-xs uppercase tracking-wide">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Product</th>
                                        <th class="px-4 py-3 text-left">Brand</th>
                                        <th class="px-4 py-3 text-left">Category</th>
                                        <th class="px-4 py-3 text-center">Ordered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topProducts as $product)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-4 flex items-center gap-4 max-w-[240px]">
                                                <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder-product.png') }}"
                                                    alt="{{ $product->name }}"
                                                    class="w-12 h-12 rounded-lg object-cover border border-gray-200 shadow-sm">
                                                <div class="flex-1">
                                                    <p class="text-gray-800 font-medium text-sm leading-snug line-clamp-2">
                                                        {{ $product->name }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-gray-600 text-sm">{{ $product->brand ?? '-' }}</td>
                                            <td class="px-4 py-4 text-gray-600 text-sm capitalize">{{ $product->category ?? '-' }}</td>
                                            <td class="px-4 py-4 text-center font-semibold text-rose-600 text-base">{{ $product->count }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">No product data yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                        <h3 class="font-semibold text-gray-800 mb-4">Recent Orders</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm border-collapse">
                                <thead>
                                    <tr class="bg-rose-50 text-rose-900">
                                        <th class="px-4 py-2">Order ID</th>
                                        <th class="px-4 py-2">Customer</th>
                                        <th class="px-4 py-2">Total</th>
                                        <th class="px-4 py-2">Status</th>
                                        <th class="px-4 py-2">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @forelse($recentOrders as $order)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-2 font-medium text-gray-800">{{ $order->_id }}</td>
                                            <td class="px-4 py-2">{{ $order->name }}</td>
                                            <td class="px-4 py-2 text-rose-600 font-semibold">Rs. {{ number_format($order->total, 2) }}</td>
                                            <td class="px-4 py-2">
                                                @if($order->status === 'pending')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                                @elseif($order->status === 'completed')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>
                                                @elseif($order->status === 'cancelled')
                                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelled</span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Unknown</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 text-gray-500">{{ $order->created_at ? $order->created_at->format('Y-m-d H:i') : '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">No recent orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</x-app-layout>
