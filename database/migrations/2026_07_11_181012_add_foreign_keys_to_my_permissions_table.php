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
        Schema::table('my_permissions', function (Blueprint $table) {
            $table->foreign(['permission_group_id'])->references(['id'])->on('permission_groups')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['permissioner_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['unit_id'])->references(['id'])->on('units')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('my_permissions', function (Blueprint $table) {
            $table->dropForeign('my_permissions_permission_group_id_foreign');
            $table->dropForeign('my_permissions_permissioner_id_foreign');
            $table->dropForeign('my_permissions_unit_id_foreign');
            $table->dropForeign('my_permissions_user_id_foreign');
        });
    }
};
