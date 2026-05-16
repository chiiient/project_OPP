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
        // Kept as a no-op because the order_details table is already created by
        // 2026_05_13_204919_create_order_details_table.php.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
