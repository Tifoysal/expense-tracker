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
        //this table is for collecting payment/bill from customer (dealer/institution) . entry by employee (users)
        Schema::create('bill_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            
            // employee will click on order dropdown. here order number with due amount will be shown (only orders which has due > 0)
            // if customer has due 300 for 2 orders then employee will receive 2 times, lets say 1st order 200 tk then 2nd order 100 tk
            // update orders.paid on each bill collection

            $table->double('amount',10,2)->default(0.0);
            $table->string('payment_type',20)->default('cash');
            $table->enum('status',['pending','disbursed','received','cancelled'])->default('pending');
            $table->dateTime('collection_date')->nullable();
            $table->dateTime('disburse_date')->nullable();
            $table->text('narration')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('receipt_file')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users');
            // received info
            $table->foreignId('banking_account_id')->nullable()->constrained('banking_accounts');

            $table->string('reference_name')->nullable()->comment('if paid via others like MD, Chairman');
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
        Schema::dropIfExists('bill_collections');
    }
};
