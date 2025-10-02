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
                        <div class="hidden sm:block text-sm text-gray-600">Hi, <span class="font-semibold text-gray-800">Admin</span></div>
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
                    <a href="{{ route('admin.messages.index') }}" class="text-sm text-rose-700 hover:underline">&larr; Back to Messages</a>

                    <div class="bg-white rounded-2xl shadow-sm border p-6 space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800">Message from {{ $message->first_name }} {{ $message->last_name }}</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                            <div>
                                <p><span class="text-gray-500">Email:</span> {{ $message->email }}</p>
                                <p><span class="text-gray-500">Phone:</span> {{ $message->phone }}</p>
                            </div>
                            <div>
                                <p><span class="text-gray-500">Received:</span> {{ $message->created_at?->format('M d, Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border text-gray-700">
                            {{ $message->message }}
                        </div>

                        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete Message</button>
                        </form>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>
