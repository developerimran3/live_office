<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('port__bills', function (Blueprint $table) {
            $table->id();

            $table->string('river_duse_20')->default(5.41);
            $table->string('river_duse_40')->default(10.82);
            $table->string('river_duse_lcl')->default(0.443);
            $table->string('lift_on_20')->default(10);
            $table->string('lift_on_40')->default(30);
            $table->string('extra_movement_20')->default(45.46);
            $table->string('extra_movement_40')->default(68.19);

            $table->string('storage_1st_20')->default(6.9);
            $table->string('storage_1st_40')->default(13.8);
            $table->string('storage_1st_20_dg')->default(27.6);
            $table->string('storage_1st_40_dg')->default(55.2);

            $table->string('storage_2nd_20')->default(13.8);
            $table->string('storage_2nd_40')->default(27.6);
            $table->string('storage_2nd_20_dg')->default(55.2);
            $table->string('storage_2nd_40_dg')->default(110.4);

            $table->string('storage_3rd_20')->default(27.6);
            $table->string('storage_3rd_40')->default(55.2);
            $table->string('storage_3rd_20_dg')->default(110.4);
            $table->string('storage_3rd_40_dg')->default(220.8);

            $table->string('storage_1st_lcl_lock')->default(.681);
            $table->string('storage_1st_lcl_ware')->default(.619);
            $table->string('storage_1st_lcl_lock_dg')->nullable();
            $table->string('storage_1st_lcl_ware_dg')->nullable();

            $table->string('storage_2nd_lcl_lock')->default(2.043);
            $table->string('storage_2nd_lcl_ware')->default(1.857);
            $table->string('storage_2nd_lcl_lock_dg')->nullable();
            $table->string('storage_2nd_lcl_ware_dg')->nullable();

            $table->string('storage_3rd_lcl_lock')->default(2.724);
            $table->string('storage_3rd_lcl_ware')->default(2.476);
            $table->string('storage_3rd_lcl_lock_dg')->nullable();
            $table->string('storage_3rd_lcl_ware_dg')->nullable();

            $table->string('rpc')->default(7.5);
            $table->string('hc')->default(5.42);
            $table->string('unstuffing')->default(5.42);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('port__bills');
    }
};
