<x-layout>
    <x-slot:heading>
        New Customer
    </x-slot:heading>

  <form action="{{ route('customers.store') }}" method="post">
    @csrf
    <div class="space-y-12"> 
      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">  
          <div class="sm:col-span-3">
            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assigned user</label>
            <div class="mt-2">
              <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">Select a User</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>  
                @endforeach
              </select>
            </div>
            @error('user_id')
              <div class="text-xs text-red-600 font-semibold mt-1">User required</div>  
            @enderror
          </div>

          <div class="sm:col-span-3">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Company name</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('name')
              <div class="text-xs text-red-600 font-semibold mt-1">Company name required</div>  
            @enderror
          </div>

          <div class="sm:col-span-3">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email address</label>  
            <input id="email" name="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('email')
              <div class="text-xs text-red-600 font-semibold mt-1">Email address required</div>  
            @enderror
          </div>

          <div class="sm:col-span-3">
            <label for="number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contact number</label>  
            <input type="text" name="number" id="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            @error('number')
              <div class="text-xs text-red-600 font-semibold mt-1">Contact number required</div> 
            @enderror
          </div>

          <div class="col-span-full">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Invoice address</label>  
            <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Start typing and select your address">
            @error('address')
              <div class="text-xs text-red-600 font-semibold mt-1">Invoice address required</div>  
            @enderror
          </div>

        </div>
      </div>   
    </div>
    
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</button>
      <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Save</button>
    </div>
  </form>

  @if (session()->has('success'))
  <p class="text-green-700">
      {{ session()->get('success'); }}
  </p>
  @endif

</x-layout>