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
        Schema::create('banking_accounts', function (Blueprint $table) {

            $table->id();

            $table->enum('type', ['bank','mfs', 'cash'])->comment('Type of account');
            $table->string('name');
            $table->string('account_no')->nullable();
            $table->enum('status', ['active', 'frozen'])->default('active');

            $table->string('currency', 3)->nullable(); // e.g., BDT, USD, EUR

            $table->decimal('starting_balance', 15, 2)->default(0.00);
            $table->decimal('balance', 15, 2)->default(0.00);

            $table->boolean('default_account')->default(false); // cleaner than integer 0/1

            $table->string('bank_name')->nullable();
            $table->string('bank_phone')->nullable();
            $table->string('bank_address')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('banking_accounts');
    }
};
