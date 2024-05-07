<x-layout>
    <x-slot:heading>
        Customers Page
    </x-slot:heading>

    @php
        $items = $customers;
    @endphp
    
    <x-table :columns="$columns" :items="$items"></x-table>
    {{ $customers->links() }}

</x-layout>