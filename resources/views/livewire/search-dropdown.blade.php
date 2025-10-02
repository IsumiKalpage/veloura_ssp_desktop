<div 
    x-data="{ open: false }" 
    @click.away="open = false" 
    @keydown.escape.window="open = false" 
    class="relative w-full"
>
    {{-- 🔍 Search Input --}}
    <form wire:submit.prevent="search" class="relative">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="query"
            placeholder="Search products..."
            class="rounded-full border border-rose-300 focus:ring-rose-500 focus:border-rose-500 pl-4 pr-10 py-2 w-full shadow-sm"
            @focus="open = true"
            @keydown.arrow-down.prevent="$wire.incrementHighlight(); open = true"
            @keydown.arrow-up.prevent="$wire.decrementHighlight(); open = true"
            @keydown.enter.prevent="$wire.selectHighlighted()"
        />
        <span class="absolute right-3 top-2.5 text-rose-700">
            <i class="fas fa-search"></i>
        </span>
    </form>

    {{-- 📌 Results Dropdown --}}
    @if(!empty($results))
        <div 
            x-show="open"
            x-transition
            class="absolute z-50 mt-2 left-1/2 -translate-x-1/2 
                   w-[90vw] sm:w-[28rem] 
                   bg-white border border-gray-200 rounded-xl shadow-2xl 
                   max-h-96 overflow-y-auto"
        >
            @forelse($results as $i => $product)
                <a href="{{ route('shop.show', $product) }}" 
                   class="flex items-center gap-4 px-5 py-4 transition duration-150 ease-in-out
                          {{ $highlightIndex === $i ? 'bg-rose-100' : 'hover:bg-rose-50' }}">
                    
                    {{-- Product Image --}}
                    <img src="{{ $product->image_path ? asset('storage/'.$product->image_path) : asset('images/placeholder-product.png') }}"
                         class="h-14 w-14 object-cover rounded-lg border shadow-sm">

                    {{-- Product Info --}}
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-gray-900 line-clamp-1">{{ $product->name }}</p>
                        <p class="text-xs text-gray-500">{{ $product->brand }}</p>
                    </div>

                    {{-- Price --}}
                    <div class="text-right">
                        @if($product->discount > 0)
                            @php $discountedPrice = $product->price - ($product->price * ($product->discount / 100)); @endphp
                            <p class="text-sm font-bold text-rose-600">Rs. {{ number_format($discountedPrice,2) }}</p>
                            <p class="text-xs text-gray-400 line-through">Rs. {{ number_format($product->price,2) }}</p>
                        @else
                            <p class="text-sm font-bold text-rose-600">Rs. {{ number_format($product->price,2) }}</p>
                        @endif
                    </div>
                </a>
            @empty
                <p class="px-5 py-4 text-sm text-gray-500">No products found.</p>
            @endforelse

            {{-- 🔗 "See all results" --}}
            @if($query)
                <div class="px-5 py-3 border-t bg-gray-50 text-center">
                    <a href="{{ route('shop.index', ['search' => $query]) }}" 
                       class="text-sm font-medium text-rose-600 hover:text-rose-700">
                        See all results for "{{ $query }}" →
                    </a>
                </div>
            @endif
        </div>
    @endif
</div>
