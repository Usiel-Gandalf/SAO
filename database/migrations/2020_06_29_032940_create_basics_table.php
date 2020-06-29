<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basics', function (Blueprint $table) {
            $table->id();
            $table->integer('titular_id')->nullable();
            $table->integer('locality_id')->nullable();
            $table->char('consignment', 20)->nullable();
            $table->char('fol_form', 25)->nullable();
            $table->integer('bimester')->nullable();
            $table->integer('year')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('type')->nullable();
            $table->foreign('locality_id')->references('id')->on('localities')
            ->onUpdate('cascade')
            ->onDelete('set null');
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
        Schema::dropIfExists('basics');
    }
}
