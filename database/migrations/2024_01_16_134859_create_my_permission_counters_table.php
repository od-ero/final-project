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
            $table->integer('my_permission_id')->unsigned();
            $table->foreign('my_permission_id')->references('id')->on('my_permissions');
            $table->string('frequency')->nullable();
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
