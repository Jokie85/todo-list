@extends('layouts.app')

@section('content')
<!-- Link/Button zur Startseite-->
<a href="/start" class="rainbow-button" alt="Zurück"></a>
<!--Im TaskController steht die Funktion für das Speichern der Daten. -->
<form method="post" action="/addTask">
    <div>
        <div id="addTask"><br>  <br> 
            <!--Schutz vor Cross-Site-Request-Forgery -->
            {{ csrf_field() }}
            <label class="label-headings">Kategorie <br>  
                <input class="input-boxes" type="text" name="category"><br>  <br>   
            </label>
            <label class="label-headings">Titel<br>  
                <input class="input-boxes" type="text" name="heading"><br>  <br>   
            </label>
            <label class="label-headings">Aufgaben<br>  
                <textarea rows="12" cols="40" id="tarea-task" type="text" name="description"></textarea><br> <br>  <br>   
            </label>
            <!--Speichert die Daten mit der Funktion 'saveTask' in die datenbank->tasklist = tabelle->list -->
            <input id="add-task"  type="submit" />
        </div>
    </div>
</form>
@endsection