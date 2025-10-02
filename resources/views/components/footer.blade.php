{{-- 🔹 Footer Component --}}
<footer class="bg-[#F6EDED] text-[#6B2E2E] mt-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12 grid grid-cols-1 md:grid-cols-5 gap-8">

        {{-- Logo & Social --}}
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="h-12 mb-4">
            <p class="text-sm italic">Where Skin Glows and Hair Flows</p>

            <div class="flex space-x-4 mt-4 text-2xl">
                <a href="#" class="hover:text-rose-600"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="hover:text-rose-600"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="hover:text-rose-600"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#" class="hover:text-rose-600"><i class="fa-brands fa-twitter"></i></a>
            </div>

        </div>

        {{-- Discover --}}
        <div>
            <h3 class="font-bold mb-3">Discover</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-rose-600">About Us</a></li>
                <li><a href="#" class="hover:text-rose-600">Contact Us</a></li>
                <li><a href="#" class="hover:text-rose-600">Products</a></li>
            </ul>
        </div>

        {{-- Store Policies --}}
        <div>
            <h3 class="font-bold mb-3">Store Policies</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-rose-600">Shipping Policy</a></li>
                <li><a href="#" class="hover:text-rose-600">Return / Exchange Policy</a></li>
                <li><a href="#" class="hover:text-rose-600">Terms of Service</a></li>
                <li><a href="#" class="hover:text-rose-600">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-rose-600">My Account</a></li>
            </ul>
        </div>

        {{-- Categories --}}
        <div>
            <h3 class="font-bold mb-3">Categories</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-rose-600">Haircare</a></li>
                <li><a href="#" class="hover:text-rose-600">Skincare</a></li>
                <li><a href="#" class="hover:text-rose-600">Cosmetics</a></li>
            </ul>
        </div>

        {{-- Newsletter --}}
        <div>
            <h3 class="font-bold mb-3">Subscribe to our Newsletter</h3>
            <form action="#" method="POST" class="space-y-3">
                @csrf
                <input type="email" placeholder="Enter your email"
                       class="w-full px-4 py-2 border rounded-md focus:ring-rose-500 focus:border-rose-500">
                <button type="submit" 
                        class="px-4 py-2 bg-[#7B3F3F] text-white font-semibold rounded-md hover:bg-[#5A2C2C] transition">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-[#A86C6C] text-center py-4 text-sm">
        © 2025 Veloura
    </div>
</footer>
