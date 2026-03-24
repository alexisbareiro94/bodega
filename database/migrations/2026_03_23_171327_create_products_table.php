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
        Schema::create("distributors", function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('distributor_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('barcode')->nullable()->unique();
            $table->integer('stock')->default(0);
            $table->integer('stock_min')->default(0);
            $table->decimal('price', 10, 2);
            $table->decimal('cost', 10, 2);
            $table->integer('iva')->default(10)->comment('Porcentaje de IVA: 5 o 10');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('distributors');
    }
};
