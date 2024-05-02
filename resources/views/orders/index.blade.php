<x-layout>
    <x-slot:heading>
        Orders Page
    </x-slot:heading>

    <form action="{{ route('orders.index') }}" method="get">
      <select name="product_name">
        <option value="">Select Product</option>
        <option value="DERV">DERV</option>
        <option value="IHO">IHO</option>
        <option value="Kerosene">Kerosene</option>
        <option value="Gas Oil">Gas Oil</option>
        <option value="AdBlue">AdBlue</option>
      </select>
      <input type="number" name="quantity" placeholder="Enter min quantity">
      <button type="submit">Apply Filters</button>
    </form>

    <div class="flex flex-col">
      <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
              <thead class="bg-white border-b">
                <tr>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Company
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Product
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Quantity
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    PPL
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Order Total
                  </th>
                  <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                    Time
                  </th>
                </tr>
              </thead>

              @foreach ($orders as $order)
              <tbody>
                <tr class="bg-gray-100 border-b">
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('customers.show', $order->customer->id) }}">
                      {{ $order->customer->name }}
                    </a>
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $order->product_name }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $order->quantity }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    £{{ $order->ppl }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    £{{ $order->total_cost }}
                  </td>
                  <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    {{ $order->created_at }}
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>

    {{ $orders->links() }}
</x-layout>