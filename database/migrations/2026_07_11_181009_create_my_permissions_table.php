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
        Schema::create('my_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('my_permissions_user_id_foreign');
            $table->unsignedInteger('unit_id')->index('my_permissions_unit_id_foreign');
            $table->unsignedInteger('permission_group_id')->index('my_permissions_permission_group_id_foreign');
            $table->unsignedInteger('permissioner_id')->index('my_permissions_permissioner_id_foreign');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
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
