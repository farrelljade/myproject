<x-layout>
    <x-slot:heading>
        Create New Customer
    </x-slot:heading>

    <form action="{{ route('customer_registration.store') }}" method="post">
        @csrf
        <table>
            <tr>
                <td>Company Name</td>
                <td><input type="text" name="name" value=""></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type="text" name="address" value=""></td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td><input type="text" name="number" value=""></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" value=""></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" />
                </td>
            </tr>
        </table>
    </form>
</x-layout>