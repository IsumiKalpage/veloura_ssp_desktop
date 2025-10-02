<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-rose-100 via-pink-50 to-neutral-100 flex items-center justify-center px-4">
        <!-- Glass Morphism Card -->
        <div class="w-full max-w-lg glass-card my-12">

            {{-- Success Message (after register) --}}
            @if (session('success'))
                <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Logo --}}
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Veloura Logo"
                     class="h-20 w-auto object-contain drop-shadow-md">
            </div>

            <h1 class="text-center text-2xl font-bold text-neutral-900 mb-6">User Login</h1>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg px-3 py-2">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                           class="mt-1 block w-full rounded-xl border-neutral-300 focus:border-rose-600 focus:ring-rose-600 shadow-sm bg-white/60 backdrop-blur-md" />
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
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

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2">
                        <input type="checkbox" name="remember"
                               class="rounded border-neutral-300 text-rose-700 focus:ring-rose-600">
                        <span class="text-sm text-neutral-700">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm font-medium text-rose-800 hover:text-rose-700">Forgot password?</a>
                    @endif
                </div>

                <button type="submit"
                        class="w-full rounded-xl bg-rose-800 py-3 text-white font-semibold shadow-md hover:shadow-lg hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-600 transition">
                    Login
                </button>
            </form>

            <div class="flex items-center gap-3 my-6">
                <div class="h-px bg-neutral-200 flex-1"></div>
                <span class="text-xs uppercase tracking-wider text-neutral-400">or</span>
                <div class="h-px bg-neutral-200 flex-1"></div>
            </div>

            @if (Route::has('register'))
                <p class="text-center text-neutral-700">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="font-semibold text-rose-800 hover:text-rose-700">Sign up</a>
                </p>
            @endif
        </div>
    </div>

    {{-- Glass CSS --}}
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.1); /* transparency */
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(25px) saturate(190%);
            -webkit-backdrop-filter: blur(25px) saturate(190%);
            padding: 2.5rem 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-guest-layout>
