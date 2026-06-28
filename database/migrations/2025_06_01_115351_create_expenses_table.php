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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('mamla_date')->unique(); // Ensures unique grouping per date
            $table->string("payment_method")->comment("bank, cash, mfs");
            $table->double("amount",9,2)->default(0.00);
            $table->text("narration")->nullable();
            // $table->foreignId("vendor_id")->nullable()->constrained('vendors')->onDelete('restrict');
            $table->string("representative")->nullable();
            $table->text("remarks")->nullable();
            $table->string("tran_no")->nullable();
            $table->string("reference")->nullable();
            $table->string("attachment")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
};
