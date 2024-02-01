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
            $table->id();
            $table->integer('door_schedule_id')->unsigned();
            $table->foreign('door_schedule_id')->references('id')->on('door_schedules');
            $table->integer('door_id')->unsigned();
            $table->foreign('door_id')->references('id')->on('doors');
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
