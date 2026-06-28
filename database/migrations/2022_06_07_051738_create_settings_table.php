<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('logo')->nullable();
            $table->text('web_logo')->nullable();
            $table->text('favicon')->nullable();
            $table->string('company_name', 128);
            $table->text('address')->nullable();
            $table->text('google_location')->nullable();
            $table->string('email', 128);
            $table->string('phone_number', 64)->nullable();
            $table->string('web_address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkedin')->nullable();
            $table->text('tag_line')->nullable();
            $table->text('banner')->nullable();
            $table->longText('about_us')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('return_policy')->nullable();
            $table->text('notice')->nullable();
            $table->integer("vat")->nullable();
            $table->integer("delivery_charge")->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
