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
        Schema::create('bank_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_account_id')->constrained('banking_accounts')->restrictOnDelete();
            $table->foreignId('to_account_id')->constrained('banking_accounts');
            $table->date('date');
            $table->double('amount',8,2)->default(0.00);
            $table->text('description')->nullable();
            $table->string('payment_method',30);
            $table->string('reference')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('bank_transfers');
    }
};
