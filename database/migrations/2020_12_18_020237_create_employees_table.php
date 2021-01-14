<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->BigInteger("user_id")->unsigned();
            $table->string("full_name",60);
            $table->date("date_of_birth");
            $table->string("phone_number");
            $table->string("ID_card");
            $table->string("address",150);
            $table->String("avatar");
            $table->bigInteger("salary_id")->unsigned();
            $table->string("salary_value");
            $table->date("in_date");
            $table->date("out_date")->nullable();
            $table->bigInteger("insurance_id")->unsigned()->nullable();
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('employees',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
