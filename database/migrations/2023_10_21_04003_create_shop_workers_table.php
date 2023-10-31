<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('shop_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained('addresses');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('work_id')->constrained('works');
            $table->foreignId('shop_id')->constrained('shops');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('shop_workers');
    }
    
};
