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
        Schema::table('users', function (Blueprint $table) {
            // Add a boolean column
            $table->boolean('notifications_switch')->default(1)->after('email'); // default value 1
            $table->string('phone')->after('notifications_switch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the changes made in the "up" method
            $table->dropColumn('notifications_switch');
            $table->dropColumn('phone');
        });
    }
};
