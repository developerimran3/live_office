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
        Schema::create('bill__generates', function (Blueprint $table) {
            $table->id();
            $table->string('cl_date');
            $table->string('w/r_date');
            $table->string('upto_date');
            $table->string('unstiffing_date');
            $table->string('extra_movement');
            $table->string('h/c');
            $table->string('rpc');
            $table->string('qty');
            $table->string('usd');
            $table->string('cont');
            $table->string('dg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill__generates');
    }
};
