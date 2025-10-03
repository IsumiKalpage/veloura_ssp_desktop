<x-app-layout>
    <div class="min-h-screen bg-neutral-50">
        {{-- Shipping Banner --}}
        <div class="bg-gradient-to-r from-rose-100 to-pink-100 border-b border-rose-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center text-sm py-2 text-rose-900 font-medium">
                    Shipping done all across the country!
                </div>
            </div>
        </div>
        <x-navbar />

        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10 grid grid-cols-1 md:grid-cols-[250px_1fr] gap-8">
            
            {{-- Sidebar Filters (desktop only) --}}
            <aside class="hidden md:block bg-white rounded-xl shadow-sm border border-gray-100 p-5 h-fit sticky top-24">
                <h3 class="font-semibold text-gray-800 mb-4">Filters</h3>

                <form method="GET" action="{{ route('shop.skincare') }}" class="flex flex-col gap-5">
                    {{-- Brand --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <input type="text" name="brand" value="{{ request('brand') }}" placeholder="e.g. Anua, LA Girl..."
                               class="w-full h-10 px-3 border rounded-lg text-sm">
                    </div>

                    {{-- Rating --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Minimum Rating</label>
                        <select name="rating" class="w-full h-10 px-3 border rounded-lg text-sm">
                            <option value="">Any</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} ★ & up
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Price Range --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                        <div class="flex gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                   class="w-1/2 h-10 px-3 border rounded-lg text-sm">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                   class="w-1/2 h-10 px-3 border rounded-lg text-sm">
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-2">
                        <button type="submit" class="w-full py-2 bg-rose-600 text-white text-sm rounded-lg hover:bg-rose-700">
                            Apply
                        </button>
                        <a href="{{ route('shop.skincare') }}" 
                           class="w-full py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 text-center">
                            Reset
                        </a>
                    </div>
                </form>
            </aside>

            {{-- Product Grid --}}
            <section>
                {{-- Mobile Filter Toggle --}}
                <div x-data="{ open: false }" class="md:hidden mb-6">
                    <button @click="open = !open" 
                            class="w-full py-2 bg-rose-600 text-white text-sm rounded-lg hover:bg-rose-700">
                        Filters
                    </button>

                    {{-- Collapsible Filter Panel --}}
                    <div x-show="open" x-transition class="mt-4 bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                        <form method="GET" action="{{ route('shop.skincare') }}" class="flex flex-col gap-5">
                            {{-- Brand --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                                <input type="text" name="brand" value="{{ request('brand') }}" placeholder="e.g. Anua, LA Girl..."
                                       class="w-full h-10 px-3 border rounded-lg text-sm">
                            </div>

                            {{-- Rating --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Minimum Rating</label>
                                <select name="rating" class="w-full h-10 px-3 border rounded-lg text-sm">
                                    <option value="">Any</option>
                                    @for ($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                            {{ $i }} ★ & up
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Price Range --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                                <div class="flex gap-2">
                                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                           class="w-1/2 h-10 px-3 border rounded-lg text-sm">
                                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                           class="w-1/2 h-10 px-3 border rounded-lg text-sm">
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="flex gap-2">
                                <button type="submit" class="w-full py-2 bg-rose-600 text-white text-sm rounded-lg hover:bg-rose-700">
                                    Apply
                                </button>
                                <a href="{{ route('shop.skincare') }}" 
                                   class="w-full py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 text-center">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Product Count --}}
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $products->total() }} Skincare Products</h2>
                </div>

                {{-- Product Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($products as $p)
                        <a href="{{ route('shop.show', $p) }}" class="group bg-white rounded-xl shadow-md hover:shadow-lg transition p-4 block">
                            {{-- Image --}}
                            <div class="relative w-full h-56 mb-3 rounded-lg overflow-hidden">
                                @if($p->discount > 0)
                                    <span class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded-md shadow">
                                        -{{ $p->discount }}%
                                    </span>
                                @endif
                                <img src="{{ $p->image_path ? asset('storage/'.$p->image_path) : asset('images/placeholder-product.png') }}"
                                     class="w-full h-full object-cover absolute inset-0 group-hover:opacity-0 transition duration-300">
                                @if($p->image_path2)
                                    <img src="{{ asset('storage/'.$p->image_path2) }}"
                                         class="w-full h-full object-cover absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-300">
                                @endif
                            </div>

                            {{-- Info --}}
                            <div>
                                <h3 class="font-semibold text-gray-900 text-sm mb-1">{{ $p->name }}</h3>
                                <p class="text-xs text-gray-500 mb-1">{{ $p->brand }}</p>
                                <p class="text-yellow-500 text-xs mb-2">
                                    @for ($i = 0; $i < $p->rating; $i++) ★ @endfor
                                    @for ($i = $p->rating; $i < 5; $i++) ☆ @endfor
                                </p>

                                @if($p->discount > 0)
                                    @php
                                        $discountedPrice = $p->price - ($p->price * ($p->discount / 100));
                                    @endphp
                                    <p class="text-rose-600 font-bold">Rs. {{ number_format($discountedPrice,2) }}</p>
                                    <p class="text-gray-400 line-through text-sm">Rs. {{ number_format($p->price,2) }}</p>
                                @else
                                    <p class="text-rose-600 font-bold">Rs. {{ number_format($p->price,2) }}</p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
<x-footer />
