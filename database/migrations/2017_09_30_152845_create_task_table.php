<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Task', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id') ;
            $table->text('tas_name');
            $table->boolean('done');
            $table->integer('heading_id')
                    ->unsigned()
                    ->nullable();
            //Wichtig: die Tabelle mit der "reference ID muss zuerst migriert
            //werden sonst gibt es einen Fehler. Tipp: Nummern der Migrations Dateien anpassen "
            $table->foreign('heading_id')
                    ->references('id')
                    ->on('Heading')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('Task');
    }
}
