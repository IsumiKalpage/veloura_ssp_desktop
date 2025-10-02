<x-app-layout>
    <div class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false, filterOpen: false }">
        {{-- Topbar --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100">
            <div class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <!-- Hamburger (mobile only) -->
                        <button class="md:hidden p-2 text-gray-600" @click="sidebarOpen = true">
                            <img src="{{ asset('images/hamb.png') }}" alt="Menu" class="h-6 w-6">
                        </button>
                        <!-- Logo -->
                        <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-8">
                    </div>
                    <div class="relative group">
                        <a href="{{ route('admin.profile') }}">
                            <img src="{{ asset('images/profile.png') }}" class="h-6 w-6 rounded-full ring-2 ring-white cursor-pointer">
                        </a>
                        <div class="absolute left-1/2 -translate-x-1/2 mt-2 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Admin</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-6">
                
                {{-- Sidebar (desktop) --}}
                <aside class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 p-3">
                    <nav class="flex flex-col gap-1 text-sm">
                        <a href="{{ route('admindashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-box"></i> Products</a>
                        <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-users"></i> Customers</a>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold"><i class="fas fa-shopping-cart"></i> Orders</a>
                        <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-envelope"></i> Messages</a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-chart-line"></i> Analytics</a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-cog"></i> Settings</a>
                    </nav>
                </aside>

                {{-- Sidebar Drawer (mobile) --}}
                <div class="fixed inset-0 z-40 md:hidden" x-show="sidebarOpen">
                    <div class="absolute inset-0 bg-black bg-opacity-40" @click="sidebarOpen = false"></div>
                    <div class="absolute top-0 left-0 w-64 h-full bg-white shadow-xl p-5 transform transition-transform"
                         x-show="sidebarOpen" x-transition:enter="duration-300" x-transition:leave="duration-300"
                         x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                         x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">
                        <div class="flex items-center justify-between mb-6">
                            <img src="{{ asset('images/logo.png') }}" class="h-8">
                            <button @click="sidebarOpen = false" class="text-gray-600">✕</button>
                        </div>
                        <nav class="flex flex-col gap-3 text-sm">
                            <a href="{{ route('admindashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-box"></i> Products</a>
                            <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-users"></i> Customers</a>
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold"><i class="fas fa-shopping-cart"></i> Orders</a>
                            <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-envelope"></i> Messages</a>
                        </nav>
                    </div>
                </div>

                {{-- Main --}}
                <section class="flex flex-col gap-6">
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg">{{ session('success') }}</div>
                    @endif

                    {{-- Filters --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-800">Customer Orders</h2>
                            <button class="md:hidden text-sm text-rose-600" @click="filterOpen = !filterOpen">Filters ⌄</button>
                        </div>

                        <form method="GET" action="{{ route('admin.orders.index') }}" 
                              class="grid grid-cols-1 md:grid-cols-4 gap-3" 
                              x-show="filterOpen || window.innerWidth >= 768">
                            <div class="md:col-span-2">
                                <label class="block text-xs text-gray-500 mb-1">Search</label>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Name, email, phone..."
                                       class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Status</label>
                                <select name="status" class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                    <option value="">All</option>
                                    <option value="pending" {{ request('status')==='pending'?'selected':'' }}>Pending</option>
                                    <option value="completed" {{ request('status')==='completed'?'selected':'' }}>Completed</option>
                                    <option value="cancelled" {{ request('status')==='cancelled'?'selected':'' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="flex items-end gap-2">
                                <button type="submit" class="px-4 h-10 bg-rose-600 text-white rounded-lg hover:bg-rose-700 text-sm">Apply</button>
                                <a href="{{ route('admin.orders.index') }}" class="px-4 h-10 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm">Reset</a>
                            </div>
                        </form>
                    </div>

                    {{-- Table --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="bg-rose-50 text-rose-900">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Order ID</th>
                                        <th class="px-4 py-2 text-left">Customer</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-right">Total</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @forelse($orders as $order)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-2 font-medium">{{ $order->_id }}</td>
                                            <td class="px-4 py-2">{{ $order->name }}</td>
                                            <td class="px-4 py-2">{{ $order->email }}</td>
                                            <td class="px-4 py-2 text-right text-rose-600 font-semibold">Rs. {{ number_format($order->total, 2) }}</td>
                                            <td class="px-4 py-2">
                                                <form action="{{ route('admin.orders.updateStatus', $order->_id) }}" method="POST">@csrf @method('PATCH')
                                                    <select name="status" onchange="this.form.submit()"
                                                            class="text-xs rounded-lg border-gray-300 focus:ring-rose-500 focus:border-rose-500
                                                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800 @endif">
                                                        <option value="pending" {{ $order->status==='pending'?'selected':'' }}>Pending</option>
                                                        <option value="completed" {{ $order->status==='completed'?'selected':'' }}>Completed</option>
                                                        <option value="cancelled" {{ $order->status==='cancelled'?'selected':'' }}>Cancelled</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-4 py-2 text-gray-500">{{ $order->created_at?->format('Y-m-d H:i') }}</td>
                                            <td class="px-4 py-2 text-right"><a href="{{ route('admin.orders.show', $order->_id) }}" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200">View</a></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">No orders found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $orders->appends(request()->query())->links() }}</div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>
