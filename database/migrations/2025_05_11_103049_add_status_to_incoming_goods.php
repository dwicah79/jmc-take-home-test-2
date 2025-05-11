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
        Schema::table('incoming_goods_detiles', function (Blueprint $table) {
            $table->boolean('status')->default(0)->after('incoming_goods_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incoming_goods', function (Blueprint $table) {
            //
        });
    }
};
