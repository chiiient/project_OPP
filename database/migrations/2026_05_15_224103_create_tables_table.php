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
<<<<<<< HEAD:database/migrations/2026_05_15_224103_create_tables_table.php
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->enum('status', ['available', 'occupied'])->default('available');
            $table->timestamps();
        });
=======
        // Kept as a no-op because the orders table is already created by
        // 2026_05_13_204750_create_orders_table.php.
>>>>>>> b653dc537ba58329e120a6967fb939a5974cf7c0:database/migrations/2026_05_13_233057_create_orders_table.php
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD:database/migrations/2026_05_15_224103_create_tables_table.php
        Schema::dropIfExists('tables');
=======
        //
>>>>>>> b653dc537ba58329e120a6967fb939a5974cf7c0:database/migrations/2026_05_13_233057_create_orders_table.php
    }
};
