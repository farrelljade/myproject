<x-layout>
    <x-slot:heading>
        New Order
    </x-slot:heading>

    @if (session()->has('success'))
        <p class="text-green-700">
            {{ session()->get('success'); }}
        </p>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-x-6 gap-y-8">
                    <div class="sm:col-span-2">
                        <label for="customer_search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search Customer</label>
                        <div class="mt-2">
                            @if (isset($customerId) && isset($customerName))
                                <input type="text" id="customer_search" value="{{ $customerName }}" name="customer_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search Customer" readonly>
                                <input type="hidden" id="customer_id" value="{{ $customerId }}" name="customer_id" readonly>
                            @else
                                <input type="text" id="customer_search" name="customer_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search Customer">
                                <input type="hidden" id="customer_id" name="customer_id">
                            @endif
                        </div>
                        @error('customer_id')
                            <div class="text-xs text-red-600 font-semibold mt-1">Customer field is required</div>  
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Product</label>
                        <div class="mt-2">
                            <select name="product_name" id="product_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Select a Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product }}">{{ $product }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('product_name')
                            <div class="text-xs text-red-600 font-semibold mt-1">Product field is required</div>  
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Quantity</label>
                        <div class="mt-2">
                            <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Quantity Amount">
                        </div>
                        @error('quantity')
                            <div class="text-xs text-red-600 font-semibold mt-1">Quantity is required</div>  
                        @enderror
                    </div>
                    <div class="sm:col-span-1">
                        <label for="ppl" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cost ppl</label>
                        <div class="mt-2">
                            <input type="text" name="ppl" id="ppl" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="ppl_sell_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sell ppl</label>
                        <div class="mt-2">
                            <input type="text" name="ppl_sell_at" id="ppl_sell_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Selling At">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="ppl_profit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Profit ppl</label>
                        <div class="mt-2">
                            <input type="text" name="ppl_profit" id="ppl_profit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="nett_cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nett</label>
                        <div class="mt-2">
                            <input type="text" name="nett_cost" id="nett_cost" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="vat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">VAT</label>
                        <div class="mt-2">
                            <input type="text" name="vat" id="vat" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-1">
                        <label for="total_cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total</label>
                        <div class="mt-2">
                            <input type="text" name="total_cost" id="total_cost" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>           
                    <div class="sm:col-span-1">
                        <label for="profit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Profit</label>
                        <div class="mt-2">
                            <input type="text" name="profit" id="profit" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                </div>                          

                <div class="mt-6 flex items-center justify-center gap-x-6">
                    <a href="{{ route('orders.create') }}" method="get" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create order</button>
                </div>
            </form>
        </div>
    </div>
    
</x-layout>

{{-- Add JavaScript to dynamically update the PPL and Total Costs in real time --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productSelect = document.getElementById('product_name');
        const quantityInput = document.getElementById('quantity');
        const pplInput = document.getElementById('ppl');
        const pplSellAtInput = document.getElementById('ppl_sell_at');
        const pplProfitInput = document.getElementById('ppl_profit');
        const nettCostInput = document.getElementById('nett_cost');
        const vatInput = document.getElementById('vat');
        const totalCostInput = document.getElementById('total_cost');
        const profitInput = document.getElementById('profit');
    
        const pricing = {
            'DERV': { 'threshold': 10000, 'low': 1.10, 'high': 1.05 },
            'IHO': { 'threshold': 10000, 'low': 0.70, 'high': 0.65 },
            'Kerosene': { 'threshold': 10000, 'low': 0.68, 'high': 0.63 },
            'Gas Oil': { 'threshold': 10000, 'low': 0.85, 'high': 0.80 },
            'AdBlue': { 'threshold': 10000, 'low': 0.30, 'high': 0.25 }
        };
    
        function updateCosts() {
            const selectedProduct = productSelect.value;
            const quantity = parseInt(quantityInput.value) || 0;
            const pplSellAt = parseFloat(pplSellAtInput.value) || 0;
            const pplProfit = parseFloat(pplProfitInput.value) || 0;
  
            if (selectedProduct && quantity > 0 && pricing[selectedProduct]) {
                const productPricing = pricing[selectedProduct];
                const ppl = quantity < productPricing.threshold ? productPricing.low : productPricing.high;
                pplInput.value = ppl.toFixed(2);
  
                if (pplSellAt > 0) {
                    const pplProfit = (pplSellAt - ppl).toFixed(2);
                    const nettCost = (quantity * pplSellAt).toFixed(2);
                    const vat = (nettCost * 0.20).toFixed(2);
                    const totalCost = (parseFloat(nettCost) + parseFloat(vat)).toFixed(2);
                    const profit = ((pplSellAt - ppl) * quantity).toFixed(2);
    
                    pplProfitInput.value = pplProfit;
                    nettCostInput.value = nettCost;
                    vatInput.value = vat;
                    totalCostInput.value = totalCost;
                    profitInput.value = profit;
                } else {
                    nettCostInput.value = '';
                    vatInput.value = '';
                    totalCostInput.value = '';
                    totalCostInput.value = '';
                    profitInput.value = '';
                }
            } else {
                pplInput.value = '';
                nettCostInput.value = '';
                vatInput.value = '';
                totalCostInput.value = '';
                totalCostInput.value = '';
                profitInput.value = '';
            }
        }
    
        productSelect.addEventListener('change', updateCosts);
        quantityInput.addEventListener('input', updateCosts);
        pplSellAtInput.addEventListener('input', updateCosts);
        pplProfitInput.addEventListener('input', updateCosts);
        profitInput.addEventListener('input', updateCosts);
    });
</script>
  

<!-- jQuery code to dynamically search customer name -->
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