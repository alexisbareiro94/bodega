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
        Schema::create('credit_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('total_amount', 12, 2)->comment('Monto total de la deuda');
            $table->decimal('paid_amount', 12, 2)->default(0)->comment('Monto total pagado');
            $table->decimal('remaining_amount', 12, 2)->comment('Monto pendiente');
            $table->integer('total_installments')->nullable()->comment('Cantidad de cuotas pactadas');
            $table->integer('paid_installments')->default(0)->comment('Cuotas pagadas');
            $table->enum('status', ['active', 'paid', 'overdue', 'cancelled'])->default('active');
            $table->date('due_date')->nullable()->comment('Fecha limite de pago');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_accounts');
    }
};
