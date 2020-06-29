<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholars', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->primary('id');
            $table->string('nameScholar', 100)->nullable();
            $table->string('firstSurname', 100)->nullable();
            $table->string('secondSurname', 100)->nullable();
            $table->char('gender', 1)->nullable();
            $table->char('birthDate', 25)->nullable();
            $table->char('curp', 25)->nullable();
            $table->char('level', 1)->nullable();
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
        Schema::dropIfExists('scholars');
    }
}
