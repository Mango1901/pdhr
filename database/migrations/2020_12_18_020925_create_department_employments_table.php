<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_employments', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->BigInteger("user_id")->unsigned();
            $table->BigInteger("department_id")->unsigned();
            $table->BigInteger("employee_id")->unsigned();
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('department_employments',function (Blueprint $table){
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('department_employments',function (Blueprint $table){
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
        Schema::dropIfExists('department_employments');
    }
}
