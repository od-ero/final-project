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
        Schema::create('xxxxxmy_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('permission_group_id')->unsigned();
            $table->foreign('permission_group_id')->references('id')->on('permission_groups');
            $table->integer('permissioner_id')->unsigned();
            $table->foreign('permissioner_id')->references('id')->on('users');
            $table->date('start_date')->default(date("Y-m-d"));
            $table->date('end_date')->default(date("Y-m-d"));
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
        Schema::dropIfExists('my_permissions');
    }
};
