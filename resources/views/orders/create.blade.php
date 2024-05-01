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
            <label for="customer_id" class="block text-sm font-medium leading-6 text-gray-900">Company name</label>
            <div class="mt-2">
              <select name="customer_id" id="customer_id" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">Select a Customer</option>
                @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name }}</option>                    
                @endforeach
              </select>
            </div>
            @error('customer_id')
              <div class="text-red-700 px-1.5 py-1.5">select a customer</div>  
            @enderror
          </div>
          <div class="sm:col-span-3">
            <label for="product_name" class="block text-sm font-medium leading-6 text-gray-900">Product</label>
            <div class="mt-2">
              <select name="product_name" id="product_name" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                <option value="">Select a Product</option>
                @foreach ($products as $product)
                  <option value="{{ $product }}">{{ $product }}</option>
                @endforeach
              </select>
            </div>
            @error('product_name')
              <div class="text-red-700 px-1.5 py-1.5">select a product</div>  
            @enderror
          </div>
          <div class="sm:col-span-3">
            <label for="quantity" class="block text-sm font-medium leading-6 text-gray-900">Quantity</label>
            <div class="mt-2">
              <input type="text" name="quantity" id="quantity" class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
            @error('quantity')
              <div class="text-red-700 px-1.5 py-1.5">quantity amount</div>  
            @enderror
          </div>
          <div class="sm:col-span-3">
            <label for="ppl" class="block text-sm font-medium leading-6 text-gray-900">PPL</label>
            <div class="mt-2">
              <input type="text" name="ppl" id="ppl" readonly class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>     
          <div class="sm:col-span-3">
            <label for="total_cost" class="block text-sm font-medium leading-6 text-gray-900">Total cost</label>
            <div class="mt-2">
              <input type="text" name="total_cost" id="total_cost" readonly class="block w-full rounded-md border-0 px-1.5 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
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

{{-- Add JavaScript to dynamically update the PPL and Total Costs in real time --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const productSelect = document.getElementById('product_name');
      const quantityInput = document.getElementById('quantity');
      const pplInput = document.getElementById('ppl');
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
              totalCostInput.value = (quantity * ppl).toFixed(2);
          } else {
              pplInput.value = '';
              totalCostInput.value = '';
          }
      }
  
      productSelect.addEventListener('change', updateCosts);
      quantityInput.addEventListener('input', updateCosts);
  });
</script>