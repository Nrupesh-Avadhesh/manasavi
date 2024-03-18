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
        Schema::create('raw_material_to_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('raw_material_id');
            $table->string('vendor_id');
            $table->integer('add_by')->nullable();
            $table->enum('raw_material_status', ['InActive', 'Active'])->default('InActive');
            $table->enum('vendor_status', ['InActive', 'Active'])->default('InActive');
            $table->enum('raw_material_vendor_status', ['InActive', 'Active'])->default('InActive');
            $table->enum('status', ['InActive', 'Active'])->default('InActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raw_material_to_vendors');
    }
};
