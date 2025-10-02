<x-app-layout>
    <div class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false }">
        <!-- 🔹 Topbar -->
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100">
            <div class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between">
                    
                    <!-- Left: Hamburger + Logo -->
                    <div class="flex items-center gap-3 flex-1">
                        <button class="md:hidden p-2 text-gray-600" @click="sidebarOpen = true">
                            <img src="{{ asset('images/hamb.png') }}" alt="Menu" class="h-6 w-6">
                        </button>
                        <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-8">
                    </div>

                    <!-- Right: Profile -->
                    <div class="flex items-center gap-3 ml-6">
                        <img src="{{ asset('images/profile.png') }}" class="h-6 w-6 rounded-full ring-2 ring-white">
                        <div class="hidden sm:block text-sm text-gray-600">
                            Hi, <span class="font-semibold text-gray-800">Admin</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-[1400px] px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-[220px_1fr] gap-6">
                
                <!-- Sidebar (desktop) -->
                <aside class="hidden md:block bg-white rounded-2xl shadow-sm border border-gray-100 p-3">
                    <nav class="flex flex-col gap-1 text-sm">
                        <a href="{{ route('admindashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-box"></i> Products</a>
                        <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-users"></i> Customers</a>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-shopping-cart"></i> Orders</a>
                        <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold"><i class="fas fa-envelope"></i> Messages</a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-chart-line"></i> Analytics</a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-cog"></i> Settings</a>
                    </nav>
                </aside>

                <!-- Sidebar Drawer (mobile) -->
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
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100"><i class="fas fa-shopping-cart"></i> Orders</a>
                            <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold"><i class="fas fa-envelope"></i> Messages</a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <section class="flex flex-col gap-6">
                    <h2 class="text-xl font-semibold text-gray-800">Contact Messages</h2>

                    <!-- Search -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Search Messages</h3>
                        <form method="GET" action="{{ route('admin.messages.index') }}" class="flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <input type="text" name="search" placeholder="Search by name, email, or phone..."
                                       class="w-full h-11 pl-10 pr-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 text-sm"
                                       value="{{ request('search') }}">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"
                                     viewBox="0 0 24 24" fill="none">
                                    <path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z"
                                          stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="px-4 py-2 rounded-lg border text-sm font-medium text-gray-600 hover:bg-gray-100">Search</button>
                                <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 rounded-lg border text-sm font-medium text-gray-600 hover:bg-gray-100">Reset</a>
                            </div>
                        </form>
                    </div>

                    <!-- Messages Table -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="bg-rose-50 text-rose-900">
                                        <th class="px-4 py-2 text-left">Name</th>
                                        <th class="px-4 py-2 text-left">Email</th>
                                        <th class="px-4 py-2 text-left">Phone</th>
                                        <th class="px-4 py-2 text-left">Message</th>
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y">
                                    @forelse($messages as $msg)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-4 py-2 font-medium text-gray-800">{{ $msg->first_name }} {{ $msg->last_name }}</td>
                                            <td class="px-4 py-2">{{ $msg->email }}</td>
                                            <td class="px-4 py-2">{{ $msg->phone }}</td>
                                            <td class="px-4 py-2 truncate max-w-xs">{{ Str::limit($msg->message, 40) }}</td>
                                            <td class="px-4 py-2 text-gray-500">{{ $msg->created_at?->format('Y-m-d H:i') }}</td>
                                            <td class="px-4 py-2 text-right flex gap-2 justify-end">
                                                <a href="{{ route('admin.messages.show', $msg->id) }}" class="px-3 py-1 rounded-lg bg-gray-100 hover:bg-gray-200">View</a>
                                                <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 rounded-lg bg-red-100 text-red-700 hover:bg-red-200">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No messages found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">{{ $messages->links() }}</div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>
