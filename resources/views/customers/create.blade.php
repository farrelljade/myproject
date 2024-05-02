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
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Company name</label>
            <div class="mt-2">
              <input type="text" name="name" id="name" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('name')
              <div class="text-xs text-red-600 font-semibold mt-1">Company name required</div>  
            @enderror
          </div>
          <div class="sm:col-span-4">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" name="email" type="email" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('email')
              <div class="text-xs text-red-600 font-semibold mt-1">Email address required</div>  
            @enderror
          </div>
          <div class="col-span-full">
            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Invoice address</label>
            <div class="mt-2">
              <input type="text" name="address" id="address" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Start typing and select your address">
            </div>
            @error('address')
              <div class="text-xs text-red-600 font-semibold mt-1">Invoice address required</div>  
            @enderror
          </div>
          <div class="sm:col-span-2">
            <label for="number" class="block text-sm font-medium leading-6 text-gray-900">Contact number</label>
            <div class="mt-2">
              <input type="text" name="number" id="number" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('number')
              <div class="text-xs text-red-600 font-semibold mt-1">Contact number required</div> 
            @enderror
          </div>     
        </div>
      </div>
    </div>
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>

  @if (session()->has('success'))
  <p class="text-green-700">
      {{ session()->get('success'); }}
  </p>
  @endif

</x-layout>