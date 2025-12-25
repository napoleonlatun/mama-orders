<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->integer('price')->nullable();
            $table->integer('jerseys')->nullable();
            $table->string('livraison')->nullable();
            $table->date('date_of_order')->nullable();
            $table->date('date_of_order_delivered')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }    
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
