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
        Schema::create('port_rates', function (Blueprint $table) {
            $table->id();

            $table->decimal('river_duse_20', 8, 3)->default(5.41);
            $table->decimal('river_duse_40', 8, 3)->default(10.82);
            $table->decimal('river_duse_lcl', 8, 3)->default(0.443);
            $table->decimal('lift_on_20', 8, 3)->default(10);
            $table->decimal('lift_on_40', 8, 3)->default(30);
            $table->decimal('extra_movement_20', 8, 3)->default(45.46);
            $table->decimal('extra_movement_40', 8, 3)->default(68.19);

            $table->decimal('storage_1st_20', 8, 3)->default(6.9);
            $table->decimal('storage_1st_40', 8, 3)->default(13.8);
            $table->decimal('storage_1st_20_dg', 8, 3)->default(27.6);
            $table->decimal('storage_1st_40_dg', 8, 3)->default(55.2);

            $table->decimal('storage_2nd_20', 8, 3)->default(13.8);
            $table->decimal('storage_2nd_40', 8, 3)->default(27.6);
            $table->decimal('storage_2nd_20_dg', 8, 3)->default(55.2);
            $table->decimal('storage_2nd_40_dg', 8, 3)->default(110.4);

            $table->decimal('storage_3rd_20', 8, 3)->default(27.6);
            $table->decimal('storage_3rd_40', 8, 3)->default(55.2);
            $table->decimal('storage_3rd_20_dg', 8, 3)->default(110.4);
            $table->decimal('storage_3rd_40_dg', 8, 3)->default(220.8);

            $table->decimal('storage_1st_lcl_lock', 8, 3)->default(.681);
            $table->decimal('storage_1st_lcl_ware', 8, 3)->default(.619);
            $table->decimal('storage_1st_lcl_lock_dg', 8, 3)->nullable();
            $table->decimal('storage_1st_lcl_ware_dg', 8, 3)->nullable();

            $table->decimal('storage_2nd_lcl_lock', 8, 3)->default(2.043);
            $table->decimal('storage_2nd_lcl_ware', 8, 3)->default(1.857);
            $table->decimal('storage_2nd_lcl_lock_dg', 8, 3)->nullable();
            $table->decimal('storage_2nd_lcl_ware_dg', 8, 3)->nullable();

            $table->decimal('storage_3rd_lcl_lock', 8, 3)->default(2.724);
            $table->decimal('storage_3rd_lcl_ware', 8, 3)->default(2.476);
            $table->decimal('storage_3rd_lcl_lock_dg', 8, 3)->nullable();
            $table->decimal('storage_3rd_lcl_ware_dg', 8, 3)->nullable();

            $table->decimal('rpc', 8, 3)->default(7.5);
            $table->decimal('hc', 8, 3)->default(5.42);
            $table->decimal('unstuffing', 8, 3)->default(5.42);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port_rates');
    }
};
