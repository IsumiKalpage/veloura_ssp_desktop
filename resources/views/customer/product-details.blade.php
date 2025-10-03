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

        <div class="max-w-6xl mx-auto px-6 lg:px-12 py-12 grid grid-cols-1 md:grid-cols-2 gap-10">
            
            {{--  Product Images --}}
            <div class="space-y-4">
                <div class="relative w-full h-[400px] bg-white border rounded-xl shadow-sm overflow-hidden group">
                    
                    {{-- 🔴 Discount Badge --}}
                    @if($product->discount > 0)
                        <span class="absolute top-3 left-3 z-10 bg-red-600 text-white text-sm font-semibold px-3 py-1 rounded-md shadow">
                            -{{ $product->discount }}%
                        </span>
                    @endif

                    {{-- First Image --}}
                    <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : asset('images/placeholder-product.png') }}"
                         class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0">

                    {{-- Second Image (hover) --}}
                    @if($product->image_path2)
                        <img src="{{ asset('storage/'.$product->image_path2) }}"
                             class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    @endif
                </div>
            </div>

            {{--  Product Info --}}
            <div class="flex flex-col">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>
                <p class="text-sm text-gray-500 mb-1">{{ $product->brand }}</p>
                
                {{-- Rating --}}
                <p class="text-yellow-500 text-sm mb-3">
                    @for ($i = 0; $i < $product->rating; $i++) ★ @endfor
                    @for ($i = $product->rating; $i < 5; $i++) ☆ @endfor
                </p>

                {{-- Price --}}
                @if($product->discount > 0)
                    @php
                        $discountedPrice = $product->price - ($product->price * ($product->discount / 100));
                    @endphp
                    <p class="text-gray-400 line-through text-lg">
                        Rs. {{ number_format($product->price,2) }}
                    </p>
                    <p class="text-3xl font-bold text-rose-600 mb-4">
                        Rs. {{ number_format($discountedPrice,2) }}
                    </p>
                @else
                    <p class="text-3xl font-bold text-rose-600 mb-4">
                        Rs. {{ number_format($product->price,2) }}
                    </p>
                @endif

                {{-- Description --}}
                <p class="text-gray-700 leading-relaxed mb-6">
                    {{ $product->description }}
                </p>

                {{-- Add to Cart Button --}}
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full md:w-1/2 py-3 bg-rose-600 text-white rounded-lg hover:bg-rose-700 mb-6">
                            Add to Cart
                        </button>
                    </form>
                @else
                    <button disabled class="w-full md:w-1/2 py-3 bg-gray-400 text-white rounded-lg mb-6 cursor-not-allowed">
                        Out of Stock
                    </button>
                @endif

                {{-- Extra Info --}}
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>🚚 Delivery Charge LKR 350</li>
                    <li>✅ Guaranteed 100% Authentic Products</li>
                    <li>🌏 Imported from South Korea</li>
                    <li>🔒 Secure payments</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />
