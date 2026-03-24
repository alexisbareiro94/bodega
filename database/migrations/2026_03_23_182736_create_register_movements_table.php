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
        Schema::create('register_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('register_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['opening', 'sale', 'income', 'expense', 'closing'])->comment('tipo de movimiento');
            $table->enum('payment_method', ['cash', 'card', 'transfer', 'other', 'mixed'])->default('cash');
            $table->decimal('mixto_one', 12, 2)->default(0);
            $table->decimal('mixto_two', 12, 2)->default(0);
            $table->decimal('amount', 12, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_movements');
    }
};
