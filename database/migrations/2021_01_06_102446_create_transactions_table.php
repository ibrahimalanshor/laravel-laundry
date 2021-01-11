<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->integer('weight');
            $table->date('finish');
            $table->integer('discount')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('total');
            $table->boolean('payment_status')->default(0);
            $table->boolean('working_status')->default(0);
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('packet_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
