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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->integer('category_id');
            $table->string('name');
            $table->longText('description');
            $table->string('image')->nullable();
            $table->integer('price');
            $table->integer('stock');
            // $table->text('nutrition')->nullable();
            // $table->text('full_description')->nullable();
            // $table->text('ingredient')->nullable();
            // $table->text('preparation')->nullable();
            $table->integer('view_count')->default(0);
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
