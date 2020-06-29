<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHigersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('higers', function (Blueprint $table) {
            $table->id();
            $table->integer('scholar_id')->nullable();
            $table->char('school_id')->nullable();
            $table->char('consignment', 20)->nullable();
            $table->char('fol_form', 25)->nullable();
            $table->integer('bimester')->nullable();
            $table->integer('year')->nullable();
            $table->integer('status')->nullable();
            $table->foreign('school_id')->references('id')->on('schools');
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
        Schema::dropIfExists('higers');
    }
}
