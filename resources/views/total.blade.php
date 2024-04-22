<x-layout>
    <x-slot:heading>
        {{ $customer->name }}
    </x-slot:heading>

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <table class="min-w-full">
                <thead class="bg-white border-b">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      Total Orders
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      Total Litres
                    </th>
                  </tr>
                </thead>
        
                <tbody>
                  <tr class="bg-gray-100 border-b">
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{ $totalOrders }}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                      {{ $totalQuantity }}
                    </td>
                  </tr>
                </tbody>
                </table>
              </div>
          </div>
      </div>
    </div>
    
</x-layout>