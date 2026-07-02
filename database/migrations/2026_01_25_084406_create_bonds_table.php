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
        Schema::create('bonds', function (Blueprint $table) {
            $table->id();
            // For MINUS/stok type
            $table->string('type');
            // B/E fields
            $table->json('items')->nullable();
            $table->string('be_no')->nullable();
            $table->date('be_date')->nullable();

            // বরাদ্দ fields
            $table->string('goods_name')->nullable();
            $table->decimal('allocation', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonds');
    }
};
