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
            $table->integer('door_id')->unsigned();
            $table->foreign('door_id')->references('id')->on('doors');
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
