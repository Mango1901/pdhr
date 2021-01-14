<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeOtherHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_other_salaries', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("employee_id")->unsigned();
            $table->bigInteger("other_salary_id")->unsigned();
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('employee_other_salaries',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_other_salaries',function (Blueprint $table){
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_other_salaries',function (Blueprint $table){
            $table->foreign('other_salary_id')->references('id')->on('other_salaries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_other_histories');
    }
}
