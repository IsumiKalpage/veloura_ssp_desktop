<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="max-w-md w-full bg-white shadow-2xl rounded-lg p-8 text-center">

            {{-- Veloura logo (clickable) --}}
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="mx-auto h-16 mb-4">
            </a>

            <h2 class="text-2xl font-bold text-rose-800 mb-4">User Status</h2>

            @auth
                <p class="text-green-600 mb-6">
                    You are already logged in as 
                    <span class="font-semibold text-green-700">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>.
                </p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="px-6 py-2 bg-rose-600 text-white font-semibold rounded-lg shadow-md hover:bg-rose-700 hover:shadow-lg transition">
                        Logout
                    </button>
                </form>


            @endauth

            @guest
                <p class="text-red-600 mb-6">You are not logged in.</p>
                <a href="{{ route('login') }}" 
                   class="inline-block px-6 py-2 bg-rose-700 text-white font-semibold rounded-md shadow-md hover:bg-rose-600 hover:shadow-lg transition">
                    Login
                </a>
            @endguest
        </div>
    </div>
</x-guest-layout>
