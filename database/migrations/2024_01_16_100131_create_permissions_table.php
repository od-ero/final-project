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
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_group_id')->unsigned();
            $table->foreign('permission_group_id')->references('id')->on('permission_groups');
            $table->integer('door_id')->unsigned();
            $table->foreign('door_id')->references('id')->on('doors');
            $table->string('give_permission')->nullable();
            $table->string('open')->nullable();
            $table->string('close')->nullable();
            $table->string('schedule')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
