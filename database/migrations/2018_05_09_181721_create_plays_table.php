<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaysTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('plays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(true);
            $table->integer('dimension')->nullable(true);
            $table->mediumText('tablero')->nullable(true);
            $table->mediumText('juego')->nullable(true);
            $table->string('solucion')->nullable(true);
            $table->string('posiciones')->nullable(true);
            $table->string('tiempo')->nullable(true);
            $table->integer('estado')->nullable(true);
            $table->integer('code')->nullable(true);
            $table->integer('type')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('plays');
    }

}
