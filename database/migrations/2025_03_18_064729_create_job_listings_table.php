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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('category')->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->enum('job_type', ['full-time', 'part-time', 'freelance', 'contract']);
            $table->text('requirements')->nullable();
            $table->enum('status', ['open', 'closed', 'pending'])->default('open');
            $table->date('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
