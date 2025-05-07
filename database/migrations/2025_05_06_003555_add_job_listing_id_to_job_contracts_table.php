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
        Schema::table('job_contracts', function (Blueprint $table) {
            $table->foreignUuid('job_listing_id')->nullable()->constrained('job_listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_contracts', function (Blueprint $table) {
            $table->dropForeign(['job_listing_id']);
            $table->dropColumn('job_listing_id');
        });
    }
};
