<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRewardsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_rewards_histories', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->BigInteger("user_id")->unsigned();
            $table->BigInteger("employee_id")->unsigned();
            $table->bigInteger("rewards_id")->unsigned();
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('employee_rewards_histories',function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_rewards_histories',function (Blueprint $table){
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('employee_rewards_histories',function (Blueprint $table){
            $table->foreign('rewards_id')->references('id')->on('rewards')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_rewards_histories');
    }
}
