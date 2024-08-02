<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        $table->string('session_id');
        $table->unsignedBigInteger('fruit_id');
        $table->integer('quantity');
        $table->timestamps();

        $table->foreign('fruit_id')->references('id')->on('fruits')->onDelete('cascade');
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
