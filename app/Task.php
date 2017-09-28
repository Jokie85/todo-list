<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Hier legen wir fest, dass die einzelnen Aufgaben in der Tabelle "list" gespeichert wird
    protected $table = 'List';
    // Die Felder  'category','heading' und 'description' sollen mit Daten beschrieben werden können
    protected $fillable = ['category','heading','description'];

}
