<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $heading }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <div class="min-h-full">

        <nav class="bg-green-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    @auth
                    <div class="flex items-center">
                        <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                                <a href="/" class="{{ request()->is('/') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                                <a href="{{ route('customers.index') }}" class="{{ request()->is('customers') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Customers</a>
                                <a href="{{ route('orders.index') }}" class="{{ request()->is('orders') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Orders</a>
                                <a href="{{ route('customers.create') }}" class="{{ request()->is('customers/create') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">New Customer</a>
                                <a href="{{ route('orders.create') }}" class="{{ request()->is('orders/create') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">New Order</a>
                            </div>
                        </div>      
                    </div>
                    @endauth

                    @guest
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Login</a>
                        <a href="{{ route('auth.register') }}" class="{{ request()->is('register') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Register</a>
                    </div>
                    @endguest

                    @auth
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('users.show', Auth::user()->id) }}" class="{{ request()->is('show') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">{{ Auth::user()->first_name }}</a>
                            <button type="submit" class="{{ request()->is('login') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Logout</button>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
        
            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <a href="/" class="{{ request()->is('/') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                    <a href="{{ route('customers.index') }}" class="{{ request()->is('customers') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Customers</a>
                    <a href="{{ route('orders.index') }}" class="{{ request()->is('orders') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">Orders</a>
                    <a href="{{ route('customers.create') }}" class="{{ request()->is('customers/create') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">New Customer</a>
                    <a href="{{ route('orders.create') }}" class="{{ request()->is('orders/create') ? 'bg-green-900 text-white': 'text-gray-300 hover:bg-green-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium">New Order</a>
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
            </div>
        </header>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>