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
        Schema::create('bill_generates', function (Blueprint $table) {
            $table->id();
            $table->string('cl_date')->nullable();
            $table->string('wr_date')->nullable();
            $table->string('upto_date')->nullable();
            $table->string('unst_date')->nullable();
            $table->string('extra_mov')->nullable();
            $table->string('hc')->nullable();
            $table->string('rpc')->nullable();
            $table->string('qty')->nullable();
            $table->string('usd')->nullable();
            $table->string('cont')->nullable();
            $table->string('dg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_generates');
    }
};
