<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('expertises', function (Blueprint $table) {
            $table->foreignUuid('expertise_category_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('expertises', function (Blueprint $table) {
            $table->dropForeign(['expertise_category_id']);
            $table->dropColumn('expertise_category_id');
        });
    }

};
