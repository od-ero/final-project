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
            $table->unsignedInteger('id');
            $table->unsignedInteger('permission_group_id')->index('permissions_permission_group_id_foreign');
            $table->string('give_permission')->nullable();
            $table->string('open')->nullable();
            $table->string('close')->nullable();
            $table->string('schedule')->nullable();
            $table->integer('give_permission_fre');
            $table->integer('open_fre');
            $table->integer('close_fre');
            $table->integer('schedule_fre');
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
