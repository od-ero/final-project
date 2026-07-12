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
        Schema::create('door_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('door_id')->index('door_statuses_door_id_foreign');
            $table->string('status')->nullable();
            $table->string('status_setter')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_statuses');
    }
};
