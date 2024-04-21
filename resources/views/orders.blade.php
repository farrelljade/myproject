<x-layout>
    <x-slot:heading>
        Orders Page
    </x-slot:heading>

    <ul>
        @foreach ($orders as $order)
            <li>
                <strong>{{ $order->customer->name }}</strong> - {{ $order->product_name }} - {{ $order->quantity }}LTS<br>
            </li>
        @endforeach
    </ul>
</x-layout>