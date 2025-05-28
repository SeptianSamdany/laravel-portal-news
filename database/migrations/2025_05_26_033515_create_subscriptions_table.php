<?php
// database/migrations/2024_01_01_000000_create_subscriptions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->json('interests')->nullable();
            $table->enum('frequency', ['daily', 'weekly', 'monthly'])->default('weekly');
            $table->string('payment_proof')->nullable(); // Path to uploaded file
            $table->decimal('amount', 10, 2)->nullable();
            $table->boolean('is_subscribed')->default(false);
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->text('admin_notes')->nullable();
            $table->enum('status', ['pending', 'active', 'expired', 'cancelled'])->default('pending');
            $table->timestamps();
            
            $table->index(['user_id', 'is_subscribed']);
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};