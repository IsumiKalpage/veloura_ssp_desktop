<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-rose-100 via-pink-50 to-neutral-100 px-4">
        <div class="glass-card max-w-md w-full text-center p-8">

            {{-- Veloura logo (clickable) --}}
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="mx-auto h-16 mb-6 drop-shadow-lg">
            </a>

            <h2 class="text-2xl font-semibold text-rose-800 mb-6">User Status</h2>

            @auth
                <p class="text-green-600 mb-6">
                    You are already logged in as 
                    <span class="font-semibold text-green-700">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </span>.
                </p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full px-6 py-3 bg-rose-600 text-white font-semibold rounded-xl shadow-md hover:bg-rose-700 hover:shadow-lg transition">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <p class="text-red-600 mb-6">You are not logged in.</p>
                <a href="{{ route('login') }}" 
                   class="inline-block w-full px-6 py-3 bg-rose-700 text-white font-semibold rounded-xl shadow-md hover:bg-rose-800 hover:shadow-lg transition">
                    Login
                </a>
            @endguest
        </div>
    </div>

    {{-- Glass Morphism CSS --}}
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(25px) saturate(160%);
            -webkit-backdrop-filter: blur(25px) saturate(160%);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }
    </style>
</x-guest-layout>
