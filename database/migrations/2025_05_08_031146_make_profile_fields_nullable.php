<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Make fields nullable
            $table->string('first_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->date('date_of_birth')->nullable()->change();
            $table->string('sex')->nullable()->change();

            // Add url field if it doesn't exist
            if (!Schema::hasColumn('profiles', 'url')) {
                $table->string('url')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Revert fields to not nullable
            $table->string('first_name')->nullable(false)->change();
            $table->string('last_name')->nullable(false)->change();
            $table->date('date_of_birth')->nullable(false)->change();
            $table->string('sex')->nullable(false)->change();

            // Remove url field if it was added
            if (Schema::hasColumn('profiles', 'url')) {
                $table->dropColumn('url');
            }
        });
    }
};
