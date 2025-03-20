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
        Schema::create('contract_negotiations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_contract_id')->constrained('job_contracts')->onDelete('cascade');
            $table->foreignId('expert_id')->constrained('users')->onDelete('cascade');
            $table->text('negotiation_message');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_negotiations');
    }
};
