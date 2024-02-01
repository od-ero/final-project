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
        Schema::create('door_schedule_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('permission_name')->nullable();
            $table->string('open_in')->nullable();
            $table->string('close_in')->nullable();
            $table->string('open_out')->nullable();
            $table->string('close_out')->nullable();
            $table->string('open_in_fre')->nullable();
            $table->string('close_in_fre')->nullable();
            $table->string('open_out_fre')->nullable();
            $table->string('close_out_fre')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
           
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_schedule_permissions');
    }
};
