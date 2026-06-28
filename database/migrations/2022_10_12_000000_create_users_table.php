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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // $table->foreignId('current_salary_structure_id')->nullable()->constrained('salary_structures')->nullOnDelete();
            $table->foreignId('role_id')->nullable()->constrained('roles')->cascadeOnDelete();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('nid')->nullable();
            $table->string('image')->nullable();
            $table->string('join_date')->nullable();
            $table->string('status')->nullable()->default('active');
            // $table->foreignId('designation_id')->nullable()->constrained('designations')->onDelete('restrict');
            $table->string('device_token')->nullable();

            $table->dateTime('otp_expire_at')->nullable();
            $table->boolean('is_email_verified')->default(false);
            $table->boolean('is_mobile_verified')->default(false);
            $table->text('customer_note')->nullable()->comment('keep any note about this customer');

            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
};
