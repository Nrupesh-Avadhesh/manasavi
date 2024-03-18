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
        Schema::create('proforma_detals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proforma_id');
            $table->string('container_no')->nullable();
            $table->string('no_and_kind_of_pkgs')->nullable();
            $table->foreignId('product_id');
            $table->string('HSN_code')->nullable();
            $table->string('quantity')->default('0');
            $table->string('rate')->default('0');
            $table->string('per')->nullable();
            $table->double('amount', 16, 2)->default(0.00);
            $table->integer('add_by')->nullable();
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
        Schema::dropIfExists('proforma_detals');
    }
};
