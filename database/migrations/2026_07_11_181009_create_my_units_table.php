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
        Schema::create('my_units', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('my_units_user_id_foreign');
            $table->unsignedInteger('unit_id')->index('my_units_unit_id_foreign');
            $table->unsignedInteger('role_id')->index('my_units_role_id_foreign');
            $table->date('start_date')->default('2024-01-16');
            $table->date('end_date')->default('2024-01-16');
            $table->unsignedInteger('permissioner_id')->index('my_units_permissioner_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_units');
    }
};
