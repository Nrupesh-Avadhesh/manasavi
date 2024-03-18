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
        Schema::create('raw_material_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->nullable();
            $table->foreignId('vendor_id');
            $table->date('date');
            $table->string('e_way_bill_no')->nullable();
            $table->string('payment_mode_id')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('terms_of_delivery')->nullable();
            $table->string('description')->nullable();
            $table->integer('add_by')->nullable();
            $table->double('total_amount', 16, 2)->default(0.00);
            $table->double('total_proposs_amount', 16, 2)->default(0.00);
            $table->enum('status', ['InActive', 'Active'])->default('Active');
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
        Schema::dropIfExists('raw_material_stocks');
    }
};
