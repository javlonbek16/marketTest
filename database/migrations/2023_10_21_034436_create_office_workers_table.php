<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('office_workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained('addresses');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('work_id')->constrained('works');
            $table->foreignId('office_id')->constrained('offices');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('office_workers');
    }
};
