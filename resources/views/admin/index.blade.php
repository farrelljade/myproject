{{-- <x-layout>
    <x-slot:heading>
        Admin Dashboard
    </x-slot:heading>

    <form action="{{ route('admin.index') }}" method="get" class="mb-4">
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account Manager</label>
                <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Select a Rep</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>  
                    @endforeach
                </select>
                @error('user_id')
                  <div class="text-xs text-red-600 font-semibold mt-1">required</div>  
                @enderror
            </div>
            <div>
                <label for="customer_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Customer Type</label>
                <select name="customer_status" id="customer_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Select customer</option>                    
                    <option value="active">Active customers</option>
                    <option value="trashed">Trashed Customers</option>
                </select>
                @error('customer_status')
                <div class="text-xs text-red-600 font-semibold mt-1">required</div>  
                @enderror
            </div>
        </div>
        <a href="{{ route('admin.index') }}" method="get" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reset Filters</a>
        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Apply Filters</button>
    </form>

    @if($customers->isEmpty())
        <p class="text-center text-gray-500">No customers found. Please apply a filter to see the results.</p>
    @else
    <div class="flex flex-col mt-8">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Account Number
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($customers as $customer)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ route('customers.show', $customer->id) }}" class="text-gray-600 hover:text-gray-900">
                                    {{ $customer->name }}
                                </a>              
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $customer->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($customer->trashed())
                                    <form action="{{ route('admin.restore', $customer->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Restore</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     
    {{ $customers->appends(request()->except('page'))->links() }}
</x-layout> --}}

<x-layout>
    <x-slot:heading>
        Admin Dashboard
    </x-slot:heading>

    <form action="{{ route('admin.index') }}" method="get" class="mb-4">
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Account Manager</label>
                <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Select a Rep</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>  
                    @endforeach
                </select>
                @error('user_id')
                  <div class="text-xs text-red-600 font-semibold mt-1">required</div>  
                @enderror
            </div>
            <div>
                <label for="customer_status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Customer Type</label>
                <select name="customer_status" id="customer_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Select customer</option>                    
                    <option value="active">Active customers</option>
                    <option value="trashed">Trashed Customers</option>
                </select>
                @error('customer_status')
                <div class="text-xs text-red-600 font-semibold mt-1">required</div>  
                @enderror
            </div>
        </div>
        <a href="{{ route('admin.index') }}" method="get" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reset Filters</a>
        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Apply Filters</button>
    </form>

    @if($customers->isEmpty())
        <p class="text-center text-gray-500">No customers found</p>
    @else
        <div class="flex flex-col mt-8">
            <div class="overflow-x-auto shadow-md sm:rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Company
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Account Number
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <a href="{{ route('customers.show', $customer->id) }}" class="text-gray-600 hover:text-gray-900">
                                        {{ $customer->name }}
                                    </a>              
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $customer->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if($customer->trashed())
                                        <form action="{{ route('admin.restore', $customer->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Restore</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{ $customers->appends(request()->except('page'))->links() }}
    @endif
</x-layout>
