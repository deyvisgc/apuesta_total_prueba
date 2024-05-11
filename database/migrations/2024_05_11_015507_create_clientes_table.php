<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string("document_type")->nullable();
            $table->string("document_number")->nullable();
            $table->string("name", 50)->nullable();
            // $table->string("email", 50)->nullable();
            // $table->string("password", 50)->nullable();
            $table->bigInteger("phone")->nullable();
            $table->string("player_id")->nullable();
            $table->decimal("balance")->nullable();
            $table->timestamps();
              // Índices únicos
            $table->unique(['document_number', 'player_id']);
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client');
    }
}
