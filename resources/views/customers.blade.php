<x-layout>
    <x-slot:heading>
        Customers Page
    </x-slot:heading>
          
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
              <thead class="bg-white border-b">
                <tr>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    #
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Name
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Contact Number
                  </th>
                </tr>
              </thead>

              @foreach ($customers as $customer)
              <tbody>
                <tr class="bg-gray-100 border-b">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $customer->id }}</td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('customers.total_quantity', ['id' => $customer->id]) }}">
                      {{ $customer->name }}
                    </a>
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $customer->number }}
                  </td>
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>

</x-layout>