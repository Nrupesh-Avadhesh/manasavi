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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('expense_type_id');
            $table->string('description')->nullable();
            $table->date('date')->nullable();
            $table->string('is_bill')->default('No');
            $table->string('bill_img')->nullable();
            $table->double('amount', 16, 2)->default(0.00);
            $table->integer('add_by')->nullable();
            $table->enum('status', ['InActive', 'Active'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
