{{-- resources/views/about.blade.php --}}
<x-app-layout>
    {{-- Shipping Banner --}}
        <div class="bg-gradient-to-r from-rose-100 to-pink-100 border-b border-rose-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="text-center text-sm py-2 text-rose-900 font-medium">
                    Shipping done all across the country!
                </div>
            </div>
        </div>

        {{-- Curved Elevated Navbar --}}
        <x-navbar /><br>
    <div class="bg-gray-50">

        {{-- 🔹 Hero Banner with Overlay --}}
        <section class="relative w-full h-[100px] md:h-[500px]">
            <img src="{{ asset('images/bannerAA.webp') }}" 
                 alt="About Veloura" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center 
                        bg-black/30 opacity-0 hover:opacity-100 transition-opacity duration-500">
                <h1 class="text-4xl md:text-5xl font-bold text-white">About Us</h1>
            </div>
        </section>

        <main class="max-w-7xl mx-auto px-6 lg:px-12 py-12 space-y-20">

            {{-- 🔹 Our Story --}}
            <section class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <img src="{{ asset('images/b1.jpg') }}" 
                         alt="Our Story" 
                         class="rounded-xl shadow-md w-full max-h-[280px] object-cover">
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Story</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Veloura was created to help you feel confident in your own skin and hair. 
                        We believe self-care should be simple, luxurious, and made for you.
                    </p>
                    <p class="text-gray-600 mt-3 leading-relaxed">
                        Our products are made with gentle, effective ingredients that nourish and protect— 
                        so you can glow naturally, every day.
                    </p>
                    <p class="text-gray-600 mt-3 leading-relaxed">
                        At Veloura, it's all about celebrating your moment.
                    </p>
                </div>
            </section>

            {{-- 🔹 Our Philosophy --}}
            <section class="grid md:grid-cols-2 gap-10 items-center">
                <div class="order-2 md:order-1">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Our Philosophy</h2>
                    <p class="text-gray-600 leading-relaxed">
                        At Veloura, we believe beauty starts with self-love. 
                        That’s why we create gentle, effective skincare and haircare made to 
                        celebrate your natural glow.
                    </p>
                    <p class="text-gray-600 mt-3 leading-relaxed">
                        We value clean ingredients, honest care, and products that make you feel good—inside and out.
                    </p>
                    <p class="text-gray-600 mt-3 leading-relaxed font-semibold">
                        Your beauty. Your ritual. Your moment.
                    </p>
                </div>
                <div class="order-1 md:order-2">
                    <img src="{{ asset('images/b2.jpg') }}" 
                         alt="Our Philosophy" 
                         class="rounded-xl shadow-md w-full max-h-[280px] object-cover">
                </div>
            </section>

            {{-- 🔹 Brands --}}
            <section class="text-center">
                <h2 class="text-xl font-bold text-gray-800 mb-8">Popular Brands We Work With</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-8 items-center">
                    <img src="{{ asset('images/anua2.png') }}" 
                        alt="Anua" 
                        class="h-16 mx-auto object-contain grayscale hover:grayscale-0 transform hover:scale-110 hover:shadow-lg transition duration-300 ease-in-out">
                    
                    <img src="{{ asset('images/elf.png') }}" 
                        alt="Elf" 
                        class="h-16 mx-auto object-contain grayscale hover:grayscale-0 transform hover:scale-110 hover:shadow-lg transition duration-300 ease-in-out">
                    
                    <img src="{{ asset('images/corsx.avif') }}" 
                        alt="Cosrx" 
                        class="h-16 mx-auto object-contain grayscale hover:grayscale-0 transform hover:scale-110 hover:shadow-lg transition duration-300 ease-in-out">
                    
                    <img src="{{ asset('images/la.png') }}" 
                        alt="LA Girl" 
                        class="h-16 mx-auto object-contain grayscale hover:grayscale-0 transform hover:scale-110 hover:shadow-lg transition duration-300 ease-in-out">
                    
                    <img src="{{ asset('images/maybeline.png') }}" 
                        alt="Maybelline" 
                        class="h-16 mx-auto object-contain grayscale hover:grayscale-0 transform hover:scale-110 hover:shadow-lg transition duration-300 ease-in-out">
                    
                    <img src="{{ asset('images/skin1004_logo.webp') }}" 
                        alt="Skin1004" 
                        class="h-16 mx-auto object-contain grayscale hover:grayscale-0 transform hover:scale-110 hover:shadow-lg transition duration-300 ease-in-out">
                </div>
            </section>

        </main>
    </div>
</x-app-layout>
<x-footer />
