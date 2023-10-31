<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->string('price');
            $table->boolean('sale_or_not')->default(false);
            $table->boolean('is_in_warehouse')->default(true);
            $table->boolean('is_in_shop')->default(false);
            $table->foreignId('warehouse_id')->constrained('warehouses');
            $table->foreignId('shop_id')->nullable()->constrained('shops');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('discount_id')->constrained('discounts');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
