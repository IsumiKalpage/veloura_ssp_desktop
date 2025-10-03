{{-- Navbar Component --}}
<div x-data="{ open: false }" class="w-full">
    <div class="bg-white rounded-none md:rounded-full shadow-xl mt-0 md:mt-6 px-6 md:px-8 py-4 flex items-center justify-between">

        {{-- Left: Hamburger (mobile only) --}}
        <div class="flex items-center md:hidden">
            <button @click="open = !open" class="focus:outline-none">
                <img src="{{ asset('images/hamb.png') }}" alt="Menu" class="h-7 w-7">
            </button>
        </div>

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex-1 text-center md:flex-none md:text-left">
            <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-12 w-auto mx-auto md:mx-0">
        </a>

        {{-- Desktop Links --}}
        <div class="hidden md:flex space-x-8 text-rose-900 font-medium">
            <a href="{{ route('shop.index') }}" class="relative group whitespace-nowrap transition-colors duration-200">
                Shop All
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-gradient-to-r from-rose-600 to-pink-400 transition-all duration-300 group-hover:w-full rounded-full"></span>
            </a>
            <a href="{{ route('shop.skincare') }}" class="relative group whitespace-nowrap transition-colors duration-200">
                Skincare
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-gradient-to-r from-rose-600 to-pink-400 transition-all duration-300 group-hover:w-full rounded-full"></span>
            </a>
            <a href="{{ route('shop.cosmetics') }}" class="relative group whitespace-nowrap transition-colors duration-200">
                Cosmetics
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-gradient-to-r from-rose-600 to-pink-400 transition-all duration-300 group-hover:w-full rounded-full"></span>
            </a>
            <a href="{{ route('shop.haircare') }}" class="relative group whitespace-nowrap transition-colors duration-200">
                Hair & Body
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-gradient-to-r from-rose-600 to-pink-400 transition-all duration-300 group-hover:w-full rounded-full"></span>
            </a>
            <a href="{{ route('about') }}" class="relative group whitespace-nowrap transition-colors duration-200">
                About Us
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-gradient-to-r from-rose-600 to-pink-400 transition-all duration-300 group-hover:w-full rounded-full"></span>
            </a>
            <a href="{{ route('contact') }}" class="relative group whitespace-nowrap transition-colors duration-200">
                Contact Us
                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-gradient-to-r from-rose-600 to-pink-400 transition-all duration-300 group-hover:w-full rounded-full"></span>
            </a>
        </div>

        {{-- Right: Search + Cart + Profile --}}
        <div class="flex items-center space-x-6">
            
            {{-- Desktop Search --}}
            <div class="hidden md:block w-64">
                <livewire:search-dropdown />
            </div>

            {{-- Cart --}}
            <div class="relative">
                <a href="{{ route('cart.index') }}">
                    <img src="{{ asset('images/cart.png') }}" alt="Cart" class="h-6 w-6 cursor-pointer">
                </a>
                @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-2 -right-2 bg-rose-600 text-white text-xs rounded-full px-2 py-0.5">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </div>

            {{-- Profile --}}
            <div class="relative group">
                <a href="{{ route('profile.status') }}">
                    <img src="{{ asset('images/profile.png') }}" alt="Profile" class="h-6 w-6 cursor-pointer">
                </a>
                <div class="absolute top-full mt-2 left-1/2 -translate-x-1/2 bg-white border border-neutral-200 shadow-md rounded-md px-3 py-1 text-sm text-neutral-700 opacity-0 group-hover:opacity-100 transition duration-200 whitespace-nowrap">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Dropdown --}}
    <div x-show="open" x-transition 
         class="md:hidden w-full bg-white rounded-xl shadow-lg p-5 space-y-5 text-rose-900 font-medium">
        
        {{-- Mobile Search --}}
        <div class="block md:hidden w-full">
            <livewire:search-dropdown />
        </div>


        {{-- Nav Links --}}
        <a href="{{ route('shop.index') }}" class="block">Shop All</a>
        <a href="{{ route('shop.skincare') }}" class="block">Skincare</a>
        <a href="{{ route('shop.cosmetics') }}" class="block">Cosmetics</a>
        <a href="{{ route('shop.haircare') }}" class="block">Hair & Body</a>
        <a href="{{ url('/about') }}" class="block">About Us</a>
        <a href="{{ route('contact') }}" class="block">Contact Us</a>
    </div>
</div>
