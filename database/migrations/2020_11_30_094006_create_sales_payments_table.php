<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('so_id')->nullable();
            $table->decimal('paid', 10, 2);
            $table->decimal('remaining', 10, 2);
            $table->string('file_attachment')->nullable();
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('sales_payments');
    }
}
