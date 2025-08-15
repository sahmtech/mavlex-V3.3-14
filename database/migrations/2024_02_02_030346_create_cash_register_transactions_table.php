<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_register_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cash_register_id')->index('cash_register_transactions_cash_register_id_foreign');
            $table->decimal('amount', 22, 4)->default(0);
            $table->string('pay_method')->nullable();
            $table->enum('type', ['debit', 'credit'])->index();
            $table->string('transaction_type')->nullable()->index();
            $table->integer('transaction_id')->nullable()->index();
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
        Schema::dropIfExists('cash_register_transactions');
    }
};
