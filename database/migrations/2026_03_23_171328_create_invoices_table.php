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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->string('stamp');
            $table->enum('status', ['pending', 'authorized', 'cancelled'])->default('pending');
            $table->integer('establishment')->default(1);
            $table->integer('point_of_sale')->default(1);
            $table->integer('invoice_number');            
            $table->string('full_number')->comment('numero completo ej: 001-001 000001');
            $table->date('issue_date');
            $table->decimal('total', 12, 2);
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
