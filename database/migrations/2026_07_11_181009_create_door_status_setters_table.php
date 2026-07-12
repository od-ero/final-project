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
        Schema::create('door_status_setters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('door_id')->index('door_status_setters_door_id_foreign');
            $table->string('status')->nullable();
            $table->integer('door_schedule_id')->nullable();
            $table->unsignedInteger('user_id')->index('door_status_setters_user_id_foreign');
            $table->integer('my_permission_id')->nullable();
            $table->integer('count')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_status_setters');
    }
};
