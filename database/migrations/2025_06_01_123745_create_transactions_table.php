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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['credit', 'debit']);
            $table->string('number')->nullable();
            $table->foreignId('account_id')->constrained('banking_accounts')->restrictOnDelete();
            $table->datetime('paid_at')->nullable();
            $table->double('amount',8,2)->default(0.00);
            $table->double('after_balance',10,2)->default(0.00);
            $table->string('currency_code')->nullable();
            $table->string('currency_rate')->nullable();
            // $table->foreignId('document_id')->constrained('documents')->restrictOnDelete();
            $table->string('attachment')->nullable();
            $table->string('contact_id')->nullable();
            $table->text('description')->nullable();
            $table->string('reference')->nullable();
            $table->enum('payment_method', ['cash', 'bank', 'mfs']);
            $table->string('created_by');
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
};
