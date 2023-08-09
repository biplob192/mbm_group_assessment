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
        Schema::create('issued_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisitions_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('quantity');
            $table->double('total_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issued_items');
    }
};
