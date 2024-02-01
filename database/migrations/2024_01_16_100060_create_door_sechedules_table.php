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
        Schema::create('fffdoor_sechedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('door_id')->unsigned();
            $table->foreign('door_id')->references('id')->on('doors');
            $table->date('start_date')->default(date("Y-m-d"));
            $table->date('end_date')->default(date("Y-m-d"));
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('frequency')->nullable();
            $table->integer('door_sechedule_permission_id')->unsigned();
            $table->foreign('door_sechedule_permission_id')->references('id')->on('door_sechedule_permissions');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('door_sechedules');
    }
};
