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
        Schema::create('my_permission_counters', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('my_permission_id')->index('my_permission_counters_my_permission_id_foreign');
            $table->integer('door_id');
            $table->integer('give_permission')->nullable()->default(0);
            $table->integer('open')->default(0);
            $table->integer('close')->default(0);
            $table->integer('schedule')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_permission_counters');
    }
};
