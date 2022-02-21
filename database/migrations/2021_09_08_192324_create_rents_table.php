<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('customer_id')->constrained('customers');
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->decimal('pick_amount', 10, 2)->nullable();
            $table->decimal('book_amount', 10, 2)->nullable();
            $table->decimal('insurance_amount', 10, 2)->nullable();
            $table->enum('insurance_status', ['all', 'return'])->nullable();
            $table->timestamp('book_date')->nullable();
            $table->timestamp('pick_date')->nullable();
            $table->timestamp('deliver_date')->nullable();
            $table->decimal('penalty_amount', 10, 2)->nullable();
            $table->longText('comment')->nullable();
            $table->enum('status', ['reserved', 'taken', 'return']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
}
