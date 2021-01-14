<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string("company_name")->unique();
            $table->string("email")->unique();
            $table->string("phone_number")->unique();
            $table->tinyInteger("active");
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('users',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employees',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('department_employments',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('departments',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_salary_histories',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('insurances',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('time_sheets',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('salaries',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('other_salaries',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('rewards',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_rewards_histories',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_other_salary_histories',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_other_salaries',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('maternity_leaves',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
