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
        Schema::table('my_units', function (Blueprint $table) {
            $table->foreign(['permissioner_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['role_id'])->references(['id'])->on('roles')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['unit_id'])->references(['id'])->on('units')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('my_units', function (Blueprint $table) {
            $table->dropForeign('my_units_permissioner_id_foreign');
            $table->dropForeign('my_units_role_id_foreign');
            $table->dropForeign('my_units_unit_id_foreign');
            $table->dropForeign('my_units_user_id_foreign');
        });
    }
};
