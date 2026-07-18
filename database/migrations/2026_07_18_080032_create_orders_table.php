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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    // Delivery Address
    $table->string('name');
    $table->string('phone');
    $table->text('address');
    $table->string('city');
    $table->string('pincode');

    // Order Summary
    $table->decimal('total_amount', 10, 2);

    // Status
    $table->enum('status', [
        'pending',
        'confirmed',
        'shipped',
        'delivered',
        'cancelled'
    ])->default('pending');

    // Payment
    $table->string('payment_method')->nullable();
    $table->enum('payment_status', [
        'pending',
        'paid',
        'failed'
    ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
