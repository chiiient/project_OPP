<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained(); // Kasir/Admin
            $table->foreignId('table_id')->nullable()->constrained(); // Meja
            $table->string('customer_name')->nullable();
            $table->integer('total_price')->default(0);
<<<<<<< HEAD:database/migrations/2026_05_15_224124_create_orders_table.php
            $table->enum('status', ['pending', 'processing', 'completed', 'canceled'])->default('pending');
=======
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
>>>>>>> b653dc537ba58329e120a6967fb939a5974cf7c0:database/migrations/2026_05_13_204750_create_orders_table.php
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
