<x-layout>
    <x-slot:heading>
        Register
    </x-slot:heading>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <form action="{{ route('auth.register') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-x-6 gap-y-8">
                    <div class="max-w-sm">
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First name</label>
                        <input id="first_name" name="first_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('first_name')
                            <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="max-w-sm">
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last name</label>
                        <input id="last_name" name="last_name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('last_name')
                            <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="max-w-sm">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>
                        <input id="email" name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('email')
                            <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="max-w-sm">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('password')
                            <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="max-w-sm">
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        @error('password_confirmation')
                            <div class="text-xs text-red-600 font-semibold mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-center">
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Register</button>
                </div>
            </form>

            @if (session()->has('success'))
                <p class="text-green-700 mt-4 text-center">
                    {{ session('success') }}
                </p>
            @endif
        </div>
    </div>
    
</x-layout>
