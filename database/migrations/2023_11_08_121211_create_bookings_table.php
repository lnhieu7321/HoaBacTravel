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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('type_of_day', 50)->notNull();
            $table->integer('number_of_adults')->notNull();
            $table->integer('number_of_children')->notNull();
            $table->date('start_date')->notNull();
            $table->date('end_date')->notNull();
            $table->decimal('total_cost', 10, 2)->notNull();
            $table->string('status_book', 50)->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
