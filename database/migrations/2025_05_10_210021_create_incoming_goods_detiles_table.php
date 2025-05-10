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
        Schema::create('incoming_goods_detiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incoming_goods_id');
            $table->string('goods_name', 200);
            $table->decimal('price', 15, 2);
            $table->integer('volume');
            $table->string('unit', 40);
            $table->decimal('total', 15, 2);
            $table->date('expired_date')->nullable();
            $table->timestamps();
            $table->foreign('incoming_goods_id')->references('id')->on('incoming_goods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_goods_detiles');
    }
};
