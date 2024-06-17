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
        if (!Schema::hasTable('shipping_details')) {
            Schema::create('shipping_details', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_cart');
                $table->string('name');
                $table->string('address1');
                $table->string('address2');
                $table->string('city');
                $table->string('postal_code');
                $table->string('district');
                $table->string('state');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_details');
    }
};
