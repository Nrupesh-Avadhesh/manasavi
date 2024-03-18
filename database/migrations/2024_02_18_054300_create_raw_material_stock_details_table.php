<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('raw_material_stock_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raw_material_stock_id');
            $table->foreignId('raw_material_id');
            $table->string('quantity')->default('0');
            $table->string('rate')->default('0');
            $table->double('amount', 16, 2)->default(0.00);
            $table->string('proposs_percentage')->nullable();
            $table->double('proposs_amount', 16, 2)->default(0.00);
            $table->enum('is_edit', ['0', '1'])->default('0');
            $table->date('edit_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_stock_details');
    }
};
