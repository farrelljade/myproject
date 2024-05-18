<x-layout>
    <x-slot:heading>
        Orders Page
    </x-slot:heading>

    <form action="{{ route('orders.index') }}" method="get" class="mb-4">
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="customer_search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search Customer</label>
                <input type="text" id="customer_search" name="customer_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search Customer">
                <input type="hidden" id="customer_id" name="customer_id">
            </div>
            <div>
                <label for="order_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Order Number</label>
                <input type="number" id="order_id" name="order_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search Order Number">
            </div>
            <div>
                <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select Product</label>
                <select id="product_name" name="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="">Search Product</option>
                    <option value="DERV">DERV</option>
                    <option value="IHO">IHO</option>
                    <option value="Kerosene">Kerosene</option>
                    <option value="Gas Oil">Gas Oil</option>
                    <option value="AdBlue">AdBlue</option>
                </select>
            </div>
            <div>
                <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search Quantity">
            </div>
        </div>
        <a href="{{ route('orders.index') }}" method="get" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Reset Filters</a>
        <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Apply Filters</button>
    </form>

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
                                Order Number
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                PPL
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nett Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                VAT Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order Total
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ route('orders.show', $order->order_id) }}" class="text-gray-600 hover:text-gray-900">
                                    {{ $order->customer->name }}
                                </a>              
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->order_id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->product_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                £{{ $order->ppl_sell_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                £{{ $order->nett_cost }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                £{{ $order->vat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                £{{ $order->total_cost }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->order_created_at }}
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $orders->appends(request()->except('page'))->links() }}
</x-layout>

<!-- jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script>
  $(function() {
      $("#customer_search").autocomplete({
          source: "{{ url('api/customers/search') }}",
          minLength: 2,
          select: function(event, ui) {
              $('#customer_search').val(ui.item.value);
              $('#customer_id').val(ui.item.id);
          }
      });
  });
  </script>