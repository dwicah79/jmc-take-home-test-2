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
        Schema::table('incoming_goods', function (Blueprint $table) {
            $table->string('attachment')->nullable()->change();
            $table->string('number_document')->nullable()->change();
            $table->string('building_name')->nullable()->after('number_document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nullable', function (Blueprint $table) {
            //
        });
    }
};
