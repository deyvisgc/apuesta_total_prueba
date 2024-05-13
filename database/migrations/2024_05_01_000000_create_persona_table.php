<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string("document_type")->nullable();
            $table->string("document_number")->nullable()->unique();
            $table->string("name", 50)->nullable();
            $table->string("addres", 200)->nullable();
            $table->bigInteger("phone")->nullable();
            $table->string("cod_departament", 2)->nullable();
            $table->string("cod_province", 4)->nullable();
            $table->string("cod_district", 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}
