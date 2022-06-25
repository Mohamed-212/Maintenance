<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->date('expected_on');
            $table->decimal('sub_total_amount', 10, 2);
            $table->decimal('total_taxes', 10, 2);
            $table->decimal('paid', 10, 2);
            $table->decimal('remaining', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->unsignedBigInteger('user_id');
            $table->enum('payment_type', ['cash', 'check', 'wire_transfer']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
}
