<x-app-layout>
    {{-- Full Page Background --}}
    <div class="min-h-screen bg-gradient-to-br from-neutral-100 to-neutral-100">

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

        {{-- 🔹 Banner Section --}}
        <div class="mt-8">
            <div class="md:grid md:grid-cols-3 md:gap-0 flex overflow-x-auto snap-x snap-mandatory space-x-4 md:space-x-0 px-4 md:px-0">
                {{-- Banner 1 --}}
                <div class="relative h-[350px] md:h-[450px] min-w-[85%] md:min-w-0 snap-start">
                    <img src="{{ asset('images/banner1.jpg') }}" alt="Banner 1" class="w-full h-full object-cover rounded-lg md:rounded-none">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-6 md:px-8">
                        <h2 class="text-2xl md:text-4xl font-bold text-white mb-3">New Arrivals</h2>
                        <p class="text-white text-sm md:text-lg mb-5">Embrace pure untouched nature for your best skin yet!</p>
                        <a href="#"
                           class="w-24 md:w-28 text-center py-2 bg-[#7B3F3F] text-white font-semibold rounded-md hover:bg-[#5A2C2C] transition text-sm md:text-base">
                            Shop Now
                        </a>
                    </div>
                </div>

                {{-- Banner 2 --}}
                <div class="relative h-[350px] md:h-[450px] min-w-[85%] md:min-w-0 snap-start">
                    <img src="{{ asset('images/banner2.jpg') }}" alt="Banner 2" class="w-full h-full object-cover rounded-lg md:rounded-none">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-6 md:px-8"></div>
                </div>

                {{-- Banner 3 --}}
                <div class="relative h-[350px] md:h-[450px] min-w-[85%] md:min-w-0 snap-start">
                    <img src="{{ asset('images/banner3.jpg') }}" alt="Banner 3" class="w-full h-full object-cover rounded-lg md:rounded-none">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-6 md:px-8"></div>
                </div>
            </div>
        </div>

        {{-- 🔹 Latest Products Section --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-12">
            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-6">Latest Products</h2>

            {{-- Mobile: scrollable row | Desktop: grid --}}
            <div class="flex overflow-x-auto snap-x snap-mandatory space-x-4 md:space-x-0 md:grid md:grid-cols-3 lg:grid-cols-5 md:gap-6 pb-2">
                @forelse($latestProducts as $p)
                    <a href="{{ route('shop.show', $p) }}"
                       class="min-w-[70%] sm:min-w-[40%] md:min-w-0 bg-white rounded-xl shadow-md hover:shadow-lg transition p-3 md:p-4 block group snap-start">
                        <div class="relative w-full h-40 md:h-56 rounded-lg overflow-hidden">
                            <img src="{{ $p->image_path ? asset('storage/'.$p->image_path) : asset('images/placeholder-product.png') }}"
                                 alt="{{ $p->name }}"
                                 class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-0">
                            @if($p->image_path2)
                                <img src="{{ asset('storage/'.$p->image_path2) }}"
                                     alt="{{ $p->name }} second image"
                                     class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            @endif
                        </div>
                        <div class="mt-3">
                            <h3 class="font-semibold text-gray-900 text-xs md:text-sm mb-1">{{ $p->name }}</h3>
                            <p class="text-xs text-gray-500 mb-1">{{ $p->brand }}</p>
                            <p class="text-yellow-500 text-xs mb-2">
                                @for ($i = 0; $i < $p->rating; $i++) ★ @endfor
                                @for ($i = $p->rating; $i < 5; $i++) ☆ @endfor
                            </p>
                            <p class="text-rose-600 font-bold text-sm md:text-base">Rs. {{ number_format($p->price, 2) }}</p>
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">No products available yet.</p>
                @endforelse
            </div>
        </div>

        {{-- 🔹 Japanese Hair Care Section (unchanged) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 mt-12">
            <div class="bg-[#FAF6F4] flex flex-col justify-center px-6 md:px-10 py-6 md:py-8">
                <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-2">Japanese Hair Care</h2>
                <h3 class="text-sm md:text-lg font-semibold text-gray-800 mb-4">GLOSSY HAIR STARTS HERE</h3>
                <p class="text-gray-700 leading-relaxed mb-4 text-sm md:text-base">
                    Transform dry, color treated, or unmanageable hair with our bestselling repair set 
                    powered by Royal Jelly and deep moisture-lock technology. Tame frizz, restore shine, 
                    and enjoy salon-soft results with zero salon appointments and zero stress.
                </p>
                <a href="#"
                   class="w-24 md:w-28 text-center py-2 bg-[#A0524D] text-white font-semibold rounded-md shadow-md hover:bg-[#7B3F3F] transition text-sm md:text-base">
                    Shop Now
                </a>
            </div>
            <div class="relative h-[250px] md:h-[350px]">
                <img src="{{ asset('images/jap.webp') }}" alt="Japanese Hair Care" class="w-full h-full object-cover">
            </div>
        </div>

        {{-- 🔥 Discounted Products Section --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg md:text-xl font-bold text-gray-900">Discount Products</h2>
                <a href="{{ route('shop.index', ['discount' => 'with']) }}" class="text-sm text-gray-500 hover:text-rose-600">View All</a>
            </div>

            {{-- Mobile: scrollable row | Desktop: grid --}}
            <div class="flex overflow-x-auto snap-x snap-mandatory space-x-4 md:space-x-0 md:grid md:grid-cols-3 lg:grid-cols-5 md:gap-6 pb-2">
                @forelse ($discountedProducts as $p)
                    <a href="{{ route('shop.show', $p) }}" 
                       class="min-w-[70%] sm:min-w-[40%] md:min-w-0 bg-white rounded-xl shadow-md hover:shadow-lg transition p-3 md:p-4 block group snap-start">
                        <div class="relative w-full h-40 md:h-48 bg-gray-50 rounded-lg overflow-hidden">
                            @if($p->discount > 0)
                                <span class="absolute top-2 left-2 z-10 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded-md shadow">
                                    -{{ $p->discount }}%
                                </span>
                            @endif
                            <img src="{{ asset('storage/'.$p->image_path) }}" alt="{{ $p->name }}"
                                 class="absolute inset-0 w-full h-full object-contain transition-opacity duration-300 {{ $p->image_path2 ? 'opacity-100 group-hover:opacity-0' : '' }}">
                            @if($p->image_path2)
                                <img src="{{ asset('storage/'.$p->image_path2) }}" alt="{{ $p->name }} second image"
                                     class="absolute inset-0 w-full h-full object-contain transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            @endif
                        </div>
                        <div class="mt-3">
                            <h3 class="font-semibold text-gray-900 text-xs md:text-sm mb-1">{{ $p->name }}</h3>
                            <p class="text-xs text-gray-500 mb-1">{{ $p->brand }}</p>
                            <p class="text-yellow-500 text-xs mb-2">
                                @for ($i = 0; $i < $p->rating; $i++) ★ @endfor
                                @for ($i = $p->rating; $i < 5; $i++) ☆ @endfor
                            </p>
                            @if($p->discount > 0)
                                @php $discountedPrice = $p->price - ($p->price * ($p->discount / 100)); @endphp
                                <p class="text-rose-600 font-bold text-sm md:text-base">Rs. {{ number_format($discountedPrice, 2) }}</p>
                                <p class="text-gray-400 line-through text-xs md:text-sm">Rs. {{ number_format($p->price, 2) }}</p>
                            @else
                                <p class="text-rose-600 font-bold text-sm md:text-base">Rs. {{ number_format($p->price, 2) }}</p>
                            @endif
                        </div>
                    </a>
                @empty
                    <p class="text-gray-500">No discounted products yet.</p>
                @endforelse
            </div>
        </div>


        {{-- 🔹 ANUA Section (unchanged) --}}
        <div class="relative mt-12">
            <img src="{{ asset('images/anua.webp') }}" alt="Anua Heartleaf" class="w-full h-[220px] md:h-[380px] object-cover">
            <div class="absolute inset-0 flex items-center px-4 md:px-16">
                <div class="bg-white max-w-md p-4 md:p-8 rounded-lg shadow-lg">
                    <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-2">ANUA</h2>
                    <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-4">HEARTLEAF SOOTHING TRIAL KIT</h3>
                    <p class="text-gray-700 leading-relaxed text-xs md:text-base">
                        Indulge in the ultimate skincare experience wherever you go. 
                        The Anua Heartleaf Soothing Trial Kit delivers a harmonious 4-step routine designed to soothe and rejuvenate your skin instantly.
                    </p>
                </div>
            </div>
        </div>

        {{-- 🔹 Shop by Skin Concern (unchanged) --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-12">
            <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-6">Shop by Skin Concern</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 md:gap-6">
                @for($i = 1; $i <= 6; $i++)
                    <div class="overflow-hidden rounded-xl shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl">
                        <img src="{{ asset('images/concern'.$i.'.webp') }}" alt="Concern {{ $i }}" class="w-full h-full object-cover rounded-xl">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</x-app-layout>

<x-footer />
