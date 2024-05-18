<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Customer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            // foreign id key for company
            $table->foreignIdFor(Customer::class);
            $table->id();
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('ppl', 8, 2);
            $table->decimal('ppl_sell_at', 8, 2);
            $table->decimal('ppl_profit', 8, 2);
            $table->decimal('nett_cost', 8, 2);
            $table->decimal('vat', 8, 2);
            $table->decimal('total_cost', 8, 2);
            $table->decimal('profit', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
