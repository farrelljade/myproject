<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    {{-- Just experimenting with eloquent queries on this page for now --}}

    @foreach ($users as $user)
    {{ $loop->iteration }} - {{ $user->first_name }}'s customers have made {{ $user->orders_count }} orders<br>
    @endforeach

    <br><br>

    @foreach ($orders as $order)
    {{ $order->first_name }}'s customers have ordered {{ $order->product_name }} {{ $order->product_count }} times<br>
    @endforeach

</x-layout>