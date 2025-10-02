<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-rose-100 via-pink-50 to-neutral-100 flex items-center justify-center px-4">
        <!-- Glass Morphism Card -->
        <div class="w-full max-w-lg glass-card my-12">

            {{-- Logo --}}
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Veloura Logo"
                     class="h-20 w-auto object-contain drop-shadow-md">
            </div>

            {{-- Heading --}}
            <h1 class="text-center text-2xl font-semibold text-neutral-900 mb-6">Create Account</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- First + Last Name --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-neutral-700">First Name</label>
                        <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" required
                               class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                        @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-neutral-700">Last Name</label>
                        <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" required
                               class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                        @error('last_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Email + Phone --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-neutral-700">Phone Number</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                               class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700">Password</label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                </div>

                {{-- Show Password toggle --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="showPassword" onclick="
                        document.getElementById('password').type = this.checked ? 'text' : 'password';
                        document.getElementById('password_confirmation').type = this.checked ? 'text' : 'password';
                    " class="rounded border-neutral-300 text-rose-700 focus:ring-rose-600">
                    <label for="showPassword" class="text-sm text-neutral-700">Show Password</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full rounded-xl bg-rose-800 py-3 text-white font-semibold shadow-md hover:shadow-lg hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-600 transition">
                    Create Account
                </button>
            </form>

            {{-- Login link --}}
            @if (Route::has('login'))
                <p class="mt-6 text-center text-neutral-700">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-rose-800 hover:text-rose-700">Login here</a>
                </p>
            @endif
        </div>
    </div>

    {{-- Glass CSS --}}
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(25px) saturate(160%);
            -webkit-backdrop-filter: blur(25px) saturate(160%);
            padding: 2.5rem 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-guest-layout>
