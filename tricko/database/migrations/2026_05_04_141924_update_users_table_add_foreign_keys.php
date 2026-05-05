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
        Schema::table('users', function (Blueprint $table) {
            // remove old columns
            $table->dropColumn([
                'saved_address',
                'saved_delivery_method',
                'saved_payment_method'
            ]);

            // add new columns
            $table->foreignId('delivery_method_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('payment_method_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};



