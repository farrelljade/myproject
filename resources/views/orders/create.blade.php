<x-layout>
    <x-slot:heading>
        New Order
    </x-slot:heading>

    <form action="{{ route('orders.store') }}" method="post">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="customer_search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Search Customer</label>
                        <div class="mt-2">
                            <input type="text" id="customer_search" name="customer_search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search Customer">
                            <input type="hidden" id="customer_id" name="customer_id">
                        </div>
                        @error('customer_id')
                            <div class="text-xs text-red-600 font-semibold mt-1">Customer field is required</div>  
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
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
                    <div class="sm:col-span-3">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Quantity</label>
                        <div class="mt-2">
                            <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Quantity Amount">
                        </div>
                        @error('quantity')
                            <div class="text-xs text-red-600 font-semibold mt-1">Quantity is required</div>  
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="ppl" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">PPL</label>
                        <div class="mt-2">
                            <input type="text" name="ppl" id="ppl" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="nett_cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nett</label>
                        <div class="mt-2">
                            <input type="text" name="nett_cost" id="nett_cost" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="vat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">VAT</label>
                        <div class="mt-2">
                            <input type="text" name="vat" id="vat" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <label for="total_cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total</label>
                        <div class="mt-2">
                            <input type="text" name="total_cost" id="total_cost" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>
                    </div>           
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{ route('orders.create') }}" method="get" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create order</button>
        </div>
    </form>
    @if (session()->has('success'))
      <p class="text-green-700">
          {{ session()->get('success'); }}
      </p>
    @endif
    
</x-layout>

{{-- Add JavaScript to dynamically update the PPL and Total Costs in real time --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const productSelect = document.getElementById('product_name');
      const quantityInput = document.getElementById('quantity');
      const pplInput = document.getElementById('ppl');
      const nettCostInput = document.getElementById('nett_cost');
      const vatInput = document.getElementById('vat');
      const totalCostInput = document.getElementById('total_cost');
  
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
          if (selectedProduct && quantity > 0 && pricing[selectedProduct]) {
              const productPricing = pricing[selectedProduct];
              const ppl = quantity < productPricing.threshold ? productPricing.low : productPricing.high;
              pplInput.value = ppl.toFixed(2);
              const nettCost = nettCostInput.value = (quantity * ppl).toFixed(2);
              const vat = nettCost / 100 * 20; 
              vatInput.value = (nettCost / 100 * 20).toFixed(2);
              totalCostInput.value = (parseFloat(nettCost) + parseFloat(vatInput.value)).toFixed(2);
          } else {
              pplInput.value = '';
              nettCostInput.value = '';
              vatInput.value = '';
              totalCostInput.value = '';
          }
      }
  
      productSelect.addEventListener('change', updateCosts);
      quantityInput.addEventListener('input', updateCosts);
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