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
        Schema::create('credit_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('credit_account_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2)->comment('Monto del pago');
            $table->enum('payment_method', ['cash', 'card', 'transfer', 'other'])->default('cash');
            $table->date('payment_date');
            $table->integer('installment_number')->nullable()->comment('Numero de cuota');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_payments');
    }
};
