<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_salaries', function (Blueprint $table) {
            $table->id();
            $table->BigInteger("company_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->string("name");
            $table->string("money");
            $table->BigInteger("type");
            $table->string("value");
            $table->Integer('status')->default(0);
            $table->timestamps();
        });
        Schema::table('other_salaries',function (Blueprint $table){
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
        Schema::dropIfExists('other_salaries');
    }
}
