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
        Schema::create('my_permission_doors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('door_id')->index('my_permission_doors_door_id_foreign');
            $table->unsignedInteger('my_permission_id')->index('my_permission_doors_my_permission_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_permission_doors');
    }
};
