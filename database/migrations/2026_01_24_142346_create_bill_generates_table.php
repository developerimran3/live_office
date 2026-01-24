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

            $table->foreignId('port_rate_id')->constrained()->onDelete('cascade');

            $table->date('cl_date')->nullable();
            $table->date('wr_date')->nullable();
            $table->date('upto_date')->nullable();
            $table->date('unstf_date')->nullable();

            $table->string('extra_mov')->nullable();
            $table->string('hc')->nullable();
            $table->string('rpc')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('usd_rate', 10, 2)->nullable();
            $table->string('cont_select')->nullable(); // 20 / 40 / LCL
            $table->boolean('dg_status')->default(false);

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
