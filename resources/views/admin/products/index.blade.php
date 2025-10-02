{{-- resources/views/admin/products/index.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gray-50" x-data="{ sidebarOpen: false, filterOpen: false }">
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
                            <img src="{{ asset('images/profile.png') }}" class="h-6 w-6 ring-white cursor-pointer">
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
                <!-- Sidebar (Desktop) -->
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
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                        <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
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

                <!-- Sidebar Drawer (Mobile) -->
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
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                                <i class="fas fa-shopping-cart"></i> Orders
                            </a>
                            <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
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

                <!-- Main -->
                <section class="flex flex-col gap-6">
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Header + Add -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-semibold text-gray-800">Manage Products</h2>
                            <a href="{{ route('admin.products.create') }}"
                               class="px-4 py-2 bg-rose-600 text-white rounded-lg hover:bg-rose-700 flex items-center gap-2">
                                <i class="fas fa-plus"></i> Add Product
                            </a>
                        </div>

                        <!-- Filter Accordion (mobile collapsible, desktop inline) -->
                        <div class="md:block">
                            <button 
                                class="w-full md:hidden flex justify-between items-center bg-rose-100 px-4 py-2 rounded-lg text-sm font-medium text-rose-700 mb-3"
                                @click="filterOpen = !filterOpen">
                                Filters
                                <span x-text="filterOpen ? '−' : '+'"></span>
                            </button>

                            <form method="GET" action="{{ route('admin.products.index') }}" 
                                  class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4"
                                  x-show="filterOpen || window.innerWidth >= 768"
                                  x-transition>
                                <!-- Search -->
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Search</label>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Product name..."
                                        class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                                </div>
                                <!-- Category -->
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Category</label>
                                    <select name="category" class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                        <option value="">All</option>
                                        <option value="skincare"  {{ request('category')==='skincare'?'selected':'' }}>Skincare</option>
                                        <option value="haircare"  {{ request('category')==='haircare'?'selected':'' }}>Haircare</option>
                                        <option value="cosmetics" {{ request('category')==='cosmetics'?'selected':'' }}>Cosmetics</option>
                                    </select>
                                </div>
                                <!-- Stock -->
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Stock Status</label>
                                    <select name="stock_status" class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                        <option value="">All</option>
                                        <option value="in_stock"     {{ request('stock_status')==='in_stock'?'selected':'' }}>In Stock</option>
                                        <option value="low_stock"    {{ request('stock_status')==='low_stock'?'selected':'' }}>Low Stock</option>
                                        <option value="out_of_stock" {{ request('stock_status')==='out_of_stock'?'selected':'' }}>Out of Stock</option>
                                    </select>
                                </div>
                                <!-- Brand -->
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Brand</label>
                                    <input type="text" name="brand" value="{{ request('brand') }}" placeholder="e.g. Apple, Nivea..."
                                        class="w-full h-10 px-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 text-sm">
                                </div>
                                <!-- Rating -->
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Rating</label>
                                    <select name="rating" class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                        <option value="">All</option>
                                        @for ($i=0; $i<=5; $i++)
                                            <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                                {{ $i }} ★
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <!-- Discount -->
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Discount</label>
                                    <select name="discount" class="w-full h-10 px-3 rounded-lg border border-gray-200 text-sm">
                                        <option value="">All</option>
                                        <option value="with" {{ request('discount')==='with'?'selected':'' }}>With Discount</option>
                                        <option value="without" {{ request('discount')==='without'?'selected':'' }}>Without Discount</option>
                                    </select>
                                </div>
                                <!-- Buttons -->
                                <div class="sm:col-span-2 lg:col-span-6 flex gap-3 mt-3">
                                    <button type="submit" class="px-4 py-2 bg-rose-600 text-white rounded-lg hover:bg-rose-700">Apply</button>
                                    <a href="{{ route('admin.products.index') }}"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Reset</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-x-auto">
                        <table class="w-full text-sm text-left min-w-[600px]">
                            <thead>
                                <tr class="text-gray-600 border-b">
                                    <th class="pb-3">Product</th>
                                    <th class="pb-3">Category</th>
                                    <th class="pb-3">Stock</th>
                                    <th class="pb-3">Price</th>
                                    <th class="pb-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @php
                                    $catColors = [
                                        'skincare'  => 'bg-rose-100 text-rose-700',
                                        'haircare'  => 'bg-amber-100 text-amber-700',
                                        'cosmetics' => 'bg-violet-100 text-violet-700',
                                    ];
                                    $stockColors = [
                                        'In Stock'     => 'bg-green-100 text-green-700',
                                        'Low Stock'    => 'bg-yellow-100 text-yellow-700',
                                        'Out of Stock' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp

                                @forelse ($products as $p)
                                    @php
                                        $img = $p->image_path ? asset('storage/'.$p->image_path) : asset('images/placeholder-product.png');
                                        $stockStatus = $p->stock_status;
                                        $finalPrice = $p->discount ? $p->price - ($p->price * $p->discount / 100) : $p->price;
                                    @endphp
                                    <tr>
                                        <td class="py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="relative">
                                                    <img src="{{ $img }}" class="h-12 w-12 rounded-lg object-cover">
                                                    @if($p->discount && $p->discount > 0)
                                                        <span class="absolute -top-2 -right-2 px-2 py-1 text-[10px] font-bold rounded-full bg-red-500 text-white shadow">
                                                            -{{ rtrim(rtrim(number_format($p->discount, 2), '0'), '.') }}%
                                                        </span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-800">{{ $p->name }}</p>
                                                    <p class="text-xs text-gray-500">{{ $p->brand ?? 'No Brand' }}</p>
                                                    <p class="text-xs text-yellow-500">
                                                        @for ($i=0; $i<$p->rating; $i++) ★ @endfor
                                                        @for ($i=$p->rating; $i<5; $i++) ☆ @endfor
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $catColors[$p->category] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($p->category) }}
                                            </span>
                                        </td>
                                        <td class="py-3">
                                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $stockColors[$stockStatus] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $stockStatus }}
                                            </span>
                                            <span class="text-xs text-gray-500">({{ $p->stock }})</span>
                                        </td>
                                        <td class="py-3">
                                            @if($p->discount && $p->discount > 0)
                                                <div class="flex flex-col leading-tight">
                                                    <span class="text-xs text-gray-400 line-through">Rs. {{ number_format($p->price, 2) }}</span>
                                                    <span class="text-rose-600 font-bold text-base">Rs. {{ number_format($finalPrice, 2) }}</span>
                                                </div>
                                            @else
                                                <span class="text-gray-800 font-medium">Rs. {{ number_format($p->price, 2) }}</span>
                                            @endif
                                        </td>
                                        <td class="py-3 text-right space-x-2">
                                            <a href="{{ route('admin.products.edit', $p) }}"
                                               class="px-3 py-1 text-xs rounded-md bg-gray-200 text-gray-700 hover:bg-gray-300">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Delete this product?')">
                                                @csrf @method('DELETE')
                                                <button class="px-3 py-1 text-xs rounded-md bg-red-500 text-white hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-6 text-center text-gray-500">No products yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-app-layout>
