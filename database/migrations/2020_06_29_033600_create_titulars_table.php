<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titulars', function (Blueprint $table) {
            $table->integer('id')->unique()
            ->primary('id');
            $table->string('nameTitular', 100)->nullable();
            $table->string('firstSurname', 100)->nullable();
            $table->string('secondSurname', 100)->nullable();
            $table->string('gender', 1)->nullable();
            $table->char('birthDate', 20)->nullable();
            $table->string('curp', 25)->nullable();
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
        Schema::dropIfExists('titulars');
    }
}
