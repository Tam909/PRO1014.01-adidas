<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categories')->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0); // 0: hoạt động, 1: không hoạt động
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
    
};
