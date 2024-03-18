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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companie_id');
            $table->foreignId('customer_id');
            $table->string('invoice_no');
            $table->string('receipt_no');
            $table->date('date');
            $table->double('amount', 16, 2)->default(0.00);
            $table->double('remaining_amount', 16, 2)->default(0.00);
            $table->double('payble_amount', 16, 2)->default(0.00);
            $table->text('remark')->nullable();
            $table->enum('payment_method', ['Cash', 'Electronics Transfer', 'Cheque'])->default('Cash');
            $table->string('utr_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('cheque_no')->nullable();
            $table->date('cheque_date')->nullable();
            $table->integer('add_by')->nullable();
            $table->enum('is_edit', ['0', '1'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
