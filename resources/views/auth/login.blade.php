<x-layout>
    <x-slot:heading>
        Login
    </x-slot:heading>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                <input id="email" name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('email')
                    <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('password')
                    <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
        </div>
    </form>

    @if (session()->has('success'))
    <p class="text-green-700 mt-4">
        {{ session('success') }}
    </p>
    @endif
</x-layout>