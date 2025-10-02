<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md text-center">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                You are logged in as an Admin
            </h2>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="px-4 py-2 bg-rose-600 text-white rounded-lg hover:bg-rose-700">
                    Logout
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
