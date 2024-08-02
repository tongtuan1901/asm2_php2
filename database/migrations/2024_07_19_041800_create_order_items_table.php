<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id');
        $table->unsignedBigInteger('fruit_id');
        $table->integer('quantity');
        $table->decimal('price', 8, 2);
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        $table->foreign('fruit_id')->references('id')->on('fruits')->onDelete('cascade');
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
