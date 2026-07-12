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
        Schema::create('door_schedule_doors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('door_schedule_id')->index('door_schedule_doors_door_schedule_id_foreign');
            $table->unsignedInteger('door_id')->index('door_schedule_doors_door_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_schedule_doors');
    }
};
