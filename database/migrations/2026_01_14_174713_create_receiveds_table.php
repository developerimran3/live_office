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
        Schema::create('receiveds', function (Blueprint $table) {
            $table->id();
            // New Entry Data (Copied)
            $table->string('importer_name');
            $table->string('goods_name');
            $table->string('quantity')->nullable();
            $table->string('pkgs_code')->nullable();
            $table->string('vessel')->nullable();
            $table->string('bl_no')->unique()->nullable();
            $table->string('container_no')->nullable();
            $table->string('container_size')->nullable();
            $table->string('lc_number')->nullable();
            $table->date('lc_date')->nullable();
            $table->string('gross_weight')->nullable();
            $table->date('arivel_date')->nullable();

            // Received Only
            $table->date('document_receiver')->nullable();
            $table->string('rot_no')->nullable();
            $table->string('container_location')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('invoice_no')->unique()->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('net_weight')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiveds');
    }
};
