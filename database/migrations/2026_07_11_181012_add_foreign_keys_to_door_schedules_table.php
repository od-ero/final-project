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
        Schema::table('door_schedules', function (Blueprint $table) {
            $table->foreign(['door_schedule_permission_id'])->references(['id'])->on('door_schedule_permissions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('door_schedules', function (Blueprint $table) {
            $table->dropForeign('door_schedules_door_schedule_permission_id_foreign');
            $table->dropForeign('door_schedules_user_id_foreign');
        });
    }
};
