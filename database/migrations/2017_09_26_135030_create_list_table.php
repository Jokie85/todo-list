<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //Hier wird die Tabelle 'List' erstellt, im Ordner Seeder liegt die
    //Datei 'TaskTableSeeder' um Testdaten in die Tabelle zu füllen. 
    public function up()
    {
        Schema::create('List', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')
                    ->unsigned()
                    ->index();
            $table->string('category');
            $table->string('heading');
            $table->text('description');
            $table->boolean('done');
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
        Schema::dropIfExists('List');
    }
}