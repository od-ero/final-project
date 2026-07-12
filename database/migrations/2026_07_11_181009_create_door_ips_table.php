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
        Schema::create('door_ips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address')->nullable()->unique();
            $table->unsignedInteger('door_id')->index('door_ips_door_id_foreign');
            $table->string('device_serial_number')->nullable()->unique();
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
