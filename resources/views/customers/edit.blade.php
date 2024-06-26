<x-layout>
    <x-slot:heading>
        Update Customer Details
    </x-slot:heading>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">  
            <form action="{{ route('customers.update', $customer->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 gap-x-6 gap-y-8">    
                    <div class="max-w-sm">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Company name</label>
                        <input type="text" name="name" id="name" value="{{ $customer->name }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('name')
                            <div class="text-xs text-red-600 font-semibold mt-1">Company name required</div>  
                        @enderror
                    </div>

                    <div class="max-w-sm">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>  
                        <input id="email" name="email" type="email" value="{{ $customer->email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('email')
                            <div class="text-xs text-red-600 font-semibold mt-1">Email address required</div>  
                        @enderror
                    </div>

                    <div class="max-w-sm">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Invoice address</label>  
                        <input type="text" name="address" id="address" value="{{ $customer->address }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Start typing and select your address">
                        @error('address')
                            <div class="text-xs text-red-600 font-semibold mt-1">Invoice address required</div>  
                        @enderror
                    </div>

                    <div class="max-w-sm">
                        <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contact number</label>  
                        <input type="text" name="number" id="number" value="{{ $customer->number }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @error('number')
                            <div class="text-xs text-red-600 font-semibold mt-1">Contact number required</div> 
                        @enderror
                    </div>     
                </div>
            
                <div class="mt-6 flex items-center justify-center gap-x-6">
                    <a href="{{ route('customers.show', $customer->id) }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
                </div>
            </form>
        </div>
    </div>

    @if (session()->has('success'))
      <p class="text-green-700">
          {{ session()->get('success'); }}
      </p>
    @endif

</x-layout>