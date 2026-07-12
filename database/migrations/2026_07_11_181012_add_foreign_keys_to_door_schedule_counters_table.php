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
        Schema::table('door_schedule_counters', function (Blueprint $table) {
            $table->foreign(['door_schedule_door_id'])->references(['id'])->on('door_schedule_doors')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('door_schedule_counters', function (Blueprint $table) {
            $table->dropForeign('door_schedule_counters_door_schedule_door_id_foreign');
        });
    }
};
