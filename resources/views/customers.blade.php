<x-layout>
    <x-slot:heading>
        Customers Page
    </x-slot:heading>

    <ul>
        @foreach ($customers as $customer)
            <li>{{ $customer->name }}</li>            
        @endforeach
    </ul>
</x-layout>