<x-layout>
    <x-slot:heading>
        Order Number - {{ $order->id }}
    </x-slot:heading>

    <a href="{{ route('orders.edit', $order->id) }}" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Amend order</a>
    <a href="{{ route('customers.show', $order->customer->id ) }}" class="inline mx-4 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</a>

    <div class="flex flex-row mt-8 space-x-4">
        <div class="flex-1 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Delivery Details
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                {{ $order->customer->address }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                Special Instructions - TO BE ADDED!
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                Rep who put order on - LOGIC TO BE ADDED
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      
        <div class="flex-1 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Special Instructions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Delivery Date:</strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                PO - 12345 - LOGIC TO BE ADDED
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Invoice Date:</strong> LOGIC TO BE ADDED
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex flex-row mt-8 space-x-4">
        <div class="flex-1 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">          
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product Details
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                
                            </th>
                        </tr>
                    </thead>
        
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Product:</strong> {{ $order->product_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Quantity:</strong> {{ $order->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Cost ppl:</strong> {{ $order->ppl }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Sell ppl:</strong> {{ $order->ppl_sell_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Profit ppl:</strong> £{{ $order->ppl_profit }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Total Profit:</strong> £{{ $order->profit }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Nett Total:</strong> £{{ $order->nett_cost }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>VAT:</strong> £{{ $order->vat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Order Total:</strong> £{{ $order->total_cost }}
                            </td>
                        </tr>
                    </tbody>
                </table>        
            </div>
        </div>
    
        <div class="flex-1 overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">          
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Order Details
                            </th>
                        </tr>
                    </thead>
        
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Sales Rep:</strong> {{ $order->customer->user->first_name }} {{ $order->customer->user->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Booked By:</strong> LOGIC TO BE ADDED
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                <strong>Order Date:</strong> {{ $order->created_at }}
                            </td>
                        </tr>      
                    </tbody>
                </table>        
            </div>
        </div>
    </div>

</x-layout>