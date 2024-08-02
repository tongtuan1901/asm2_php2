<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->text('address');
        $table->decimal('total', 10, 2);
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}

   
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
