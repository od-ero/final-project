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
        Schema::create('door_sechedule_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('door_sechedule_id')->unsigned();
            $table->foreign('door_sechedule_id')->references('id')->on('door_sechedules');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_sechedule_counters');
    }
};
