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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name')->nullable()->comment('Ej: Caja Principal, Turno Mañana...');
            $table->decimal('opening_balance', 12, 2)->default(0); // saldo inicial
            $table->decimal('closing_balance', 12, 2)->nullable(); // monto de cierre real
            $table->decimal('expected_balance', 12, 2)->nullable(); // monto esperado según sistema
            $table->enum('status', ['open', 'closed'])->default('open'); // si la caja está abierta o cerrada
            $table->decimal('egresos', 12, 2)->default(0);
            $table->decimal('ingresos', 12, 2)->default(0);
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
