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
        Schema::create('proformas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companie_id');
            $table->foreignId('bank_id');
            $table->foreignId('payment_mode_id');
            $table->foreignId('customer_id');
            $table->string('proforma_no');
            $table->string('e_way_bill_no')->nullable();
            $table->date('date');
            $table->string('delivery_note')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('other_reference_no')->nullable();
            $table->string('buyers_order_no')->nullable();
            $table->string('dated')->nullable();
            $table->string('dispatch_doc_no')->nullable();
            $table->string('delivery_note_date')->nullable();
            $table->string('dispatched_through')->nullable();
            $table->string('destination')->nullable();
            $table->string('bill_of_lading')->nullable();
            $table->string('motor_vehicle_no')->nullable();
            $table->string('terms_of_delivery')->nullable();
            $table->double('round', 16, 2)->default(0.00);
            $table->double('total_amount', 16, 2)->default(0.00);
            $table->string('word_amount')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('pending');
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
        Schema::dropIfExists('proformas');
    }
};
