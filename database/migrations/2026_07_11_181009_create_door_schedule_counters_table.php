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
        Schema::create('door_schedule_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('door_schedule_door_id')->index('door_schedule_counters_door_schedule_door_id_foreign');
            $table->integer('open_in')->nullable();
            $table->integer('close_in')->nullable();
            $table->integer('open_out')->nullable();
            $table->integer('close_out')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_schedule_counters');
    }
};
