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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();

            // Copied Data (from Received)
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

            // Received fields
            $table->date('document_receiver')->nullable();
            $table->string('rot_no')->nullable();
            $table->string('container_location')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('invoice_no')->unique()->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('net_weight')->nullable();

            // Register fields
            $table->string('be_no')->unique()->nullable();
            $table->date('be_date')->nullable();
            $table->string('be_lane')->nullable();

            $table->softDeletes(); // adds deleted_at

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
