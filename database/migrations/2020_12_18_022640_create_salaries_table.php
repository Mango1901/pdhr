<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->String("name");
            $table->Integer("level");
            $table->Integer("type");
            $table->String("value")->nullable();
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('salaries',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_salary_histories',function (Blueprint $table){
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employees',function (Blueprint $table){
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
