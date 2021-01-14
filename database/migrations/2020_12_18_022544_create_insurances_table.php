<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->String("percent");
            $table->date("date");
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('insurances',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employees',function (Blueprint $table){
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurances');
    }
}
