<x-layout>
    <x-slot:heading>
        Users Page
    </x-slot:heading>

    @foreach ($users as $user)
    <a href="{{ route('users.show', $user) }}">
        {{$user->first_name }} {{ $user->last_name }}<br>
    </a>
    @endforeach
</x-layout>