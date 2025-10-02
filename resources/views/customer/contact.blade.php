<x-app-layout>
    {{-- Banner --}}
    <div class="bg-gradient-to-r from-rose-100 to-pink-100 border-b border-rose-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center text-sm py-2 text-rose-900 font-medium">
                We'd love to hear from you ✨
            </div>
        </div>
    </div>

    <x-navbar />

    <div class="max-w-7xl mx-auto px-6 lg:px-12 py-10">
        {{-- Flash success --}}
        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3">
                <ul class="list-disc ml-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            {{-- Form --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h2 class="text-2xl font-semibold text-rose-900 mb-6">Send us a message</h2>

                <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">First Name</label>
                            <input name="first_name" value="{{ old('first_name') }}" required
                                   class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500"
                                   placeholder="First Name">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Last Name</label>
                            <input name="last_name" value="{{ old('last_name') }}"
                                   class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500"
                                   placeholder="Last Name (optional)">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500"
                                   placeholder="you@example.com">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Phone</label>
                            <input name="phone" value="{{ old('phone') }}"
                                   class="w-full h-11 px-3 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500"
                                   placeholder="+94 7X XXX XXXX (optional)">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">What do you have in mind?</label>
                        <textarea name="message" rows="5" required
                                  class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-rose-500"
                                  placeholder="Tell us a bit about your question or request...">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center justify-center px-6 h-11 rounded-lg bg-rose-600 text-white font-medium hover:bg-rose-700 transition">
                        Submit
                    </button>
                </form>
            </div>

            {{-- Contact info --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">
                <h2 class="text-2xl font-semibold text-rose-900 mb-6">Contact Us</h2>

                <p class="text-gray-700 leading-7 mb-6">
                    We’d love to hear from you! Whether you have a question, feedback, or just want to say hello,
                    our team is here to help. Reach out anytime—your Veloura journey matters to us.
                </p>

                <div class="space-y-4 text-gray-800">
                    <div class="flex items-center gap-3">
                        <span class="text-rose-600 text-lg">📞</span>
                        <span>+94 77 123 4567</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-rose-600 text-lg">✉️</span>
                        <span>contact@veloura.com</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-rose-600 text-lg">📍</span>
                        <span>123 Veloura Avenue, Colombo, Sri Lanka</span>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</x-app-layout>
<x-footer />