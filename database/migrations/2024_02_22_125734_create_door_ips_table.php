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
        Schema::create('door_is', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable()->unique();
            $table->integer('door_id')->unsigned();
            $table->foreign('device_serial_number')->references('id')->on('doors');
            $table->string('ip_address')->nullable()->unique();
            $table->string('door_ip_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_ips');
    }
};
