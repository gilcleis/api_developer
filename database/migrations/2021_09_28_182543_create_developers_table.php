<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desenvolvedores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
			$table->string('sexo')->nullable();			
			$table->string('hobby')->nullable();
            $table->integer('idade')->nullable();
			$table->date('datanascimento')->nullable();;			
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desenvolvedores');
    }
}
