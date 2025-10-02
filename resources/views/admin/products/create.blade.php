{{-- resources/views/admin/products/create.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false }">
        <!-- Topbar -->
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

                    <!-- Profile -->
                    <div class="relative group">
                        <a href="{{ route('admin.profile') }}">
                            <img src="{{ asset('images/profile.png') }}" 
                                 class="h-8 w-8 rounded-full ring-2 ring-white cursor-pointer">
                        </a>
                        <div class="absolute left-1/2 -translate-x-1/2 mt-2 text-xs bg-gray-800 text-white px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                            Admin
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
                        <a href="{{ route('admindashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold">
                            <i class="fas fa-box"></i> Products
                        </a>
                        <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-users"></i> Customers
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-envelope"></i> Messages
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-chart-line"></i> Analytics
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                        <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </nav>
                </aside>

                <!-- Sidebar Drawer (mobile) -->
                <div 
                    class="fixed inset-0 z-40 md:hidden"
                    x-show="sidebarOpen"
                    x-transition:enter="transition-opacity ease-linear duration-200"
                    x-transition:leave="transition-opacity ease-linear duration-200">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-40" @click="sidebarOpen = false"></div>

                    <!-- Drawer -->
                    <div 
                        class="absolute top-0 left-0 w-64 h-full bg-white shadow-xl p-5 transform transition-transform duration-300"
                        x-show="sidebarOpen"
                        x-transition:enter-start="-translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full">
                        
                        <div class="flex items-center justify-between mb-6">
                            <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-8">
                            <button @click="sidebarOpen = false" class="text-gray-600">✕</button>
                        </div>

                        <nav class="flex flex-col gap-3 text-sm">
                            <a href="{{ route('admindashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-rose-600 bg-rose-50 font-semibold">
                                <i class="fas fa-box"></i> Products
                            </a>
                            <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-users"></i> Customers
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-envelope"></i> Messages
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-chart-line"></i> Analytics
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Form -->
                <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                        <h2 class="text-lg font-semibold text-gray-800">Add Product</h2>
                        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Back to list</a>
                    </div>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                        </div>

                        <!-- Brand -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Brand Name</label>
                            <input type="text" name="brand" value="{{ old('brand') }}"
                                   class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Price (Rs.)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                                   class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Category</label>
                            <select name="category" required
                                    class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                <option value="">Select category</option>
                                <option value="skincare" {{ old('category')==='skincare'?'selected':'' }}>Skincare</option>
                                <option value="haircare" {{ old('category')==='haircare'?'selected':'' }}>Haircare</option>
                                <option value="cosmetics" {{ old('category')==='cosmetics'?'selected':'' }}>Cosmetics</option>
                            </select>
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Stock (Qty)</label>
                            <input type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required
                                   class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Star Rating</label>
                            <select name="rating" required
                                    class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                @for ($i=0; $i<=5; $i++)
                                    <option value="{{ $i }}" {{ old('rating')==$i ? 'selected':'' }}>{{ $i }} ★</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Status</label>
                            <select name="status" required
                                    class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                <option value="active" {{ old('status')==='active'?'selected':'' }}>Active</option>
                                <option value="draft"  {{ old('status')==='draft'?'selected':'' }}>Draft</option>
                            </select>
                        </div>

                        <!-- Main Image -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Main Image</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-gray-700">
                        </div>

                        <!-- Second Image -->
                        <div>
                            <label class="block text-xs text-gray-600 mb-1">Second Image</label>
                            <input type="file" name="image2" accept="image/*"
                                   class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm file:mr-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-gray-100 file:text-gray-700">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label class="block text-xs text-gray-600 mb-1">Description</label>
                            <textarea name="description" rows="4"
                                      class="w-full px-3 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">{{ old('description') }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="md:col-span-2 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <button class="px-5 py-2 bg-rose-600 text-white rounded-lg hover:bg-rose-700">Save Product</button>
                            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-600 hover:text-gray-800">Cancel</a>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>
