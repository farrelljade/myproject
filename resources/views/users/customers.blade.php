<x-layout>
    <x-slot:heading>
        {{ $user->first_name }}'s Customers
    </x-slot:heading>

    @foreach ($customerList as $customer)
        <a href="{{ route('customers.show', $customer) }}"><p>{{ $customer->name }}</p></a>
    @endforeach

</x-layout>