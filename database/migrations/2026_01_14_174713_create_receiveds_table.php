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
            //New Enty
            $table->string('importer_name');
            $table->string('vessel')->nullable();
            $table->string('bl_no')->nullable();
            $table->string('pkgs_code')->nullable();
            $table->string('lc_number')->nullable();
            $table->date('lc_date')->nullable();
            $table->decimal('gross_weight', 15, 3)->nullable();
            $table->date('arivel_date')->nullable();

            // FROM ENTY
            $table->json('items')->nullable();
            $table->json('containers')->nullable();

            // RECEIVED ONLY
            $table->date('document_receiver')->nullable();
            $table->string('rot_no')->nullable();

            // MULTIPLE
            $table->json('container_locations')->nullable();
            $table->json('net_weights')->nullable();

            $table->string('invoice_value')->nullable();
            $table->string('invoice_no')->nullable()->unique();
            $table->date('invoice_date')->nullable();

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
