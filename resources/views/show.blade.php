@extends('layouts.app')

@section('content')
<!-- Link/Button zur Startseite-->
<a href="/start" type="submit" class="rainbow-button" alt="Zurück"></a>

<div class="back-button">
    <div class="table-container">
        <table class="table-task">
            <thead>
            <th>Kategorie</th>
            <th>Titel</th>
            <th>Aufgaben</th>
            <th>Status</th>
            <th>Erstellt am</th>
            </thead>
            <tbody id="tasks-list" name="tasks-list">
                <!-- Mit dem Blade-Tamplate, werden die von der Funktion 'getUserTasks' abgefragten Daten, 
                mit einer Foreach schleife in die Zeilen einer Tabelle ausgegeben. -->
                @foreach($usertasks as $task)
                <tr id="task{{$task->id}}" class="table-task-row">
                    <td>{{$task->category}}</td>
                    <td>{{$task->heading}}</td>
                    <td>{{$task->description}}</td>
                    <!-- Hier wird geprüfft ob die Aufgabe erledigt ist oder noch offen ist.
                         dem entsprechen soll die Ausgabe sein-->
                    @if($task->done == 1)
                    <td>erledigt</td>
                    @else
                    <td>offen</td>
                    @endif
                    <td>{{$task->created_at}}</td>
                    <td>
                        <!-- Der Link(Button Bearbiten) öffnet ein Dialog Fenster, welches frei runtergeladen ist-->
                        <a class="js-open-modal" href="#" data-modal-id="popup"><button class="edit-task" value="{{$task->id}}">Bearbeiten</button></a>
                        <button class="delete-task" value="{{$task->id}}">Löschen</button>
                    </td>
                </tr>   
                @endforeach
            </tbody>
        </table> 
    </div> 
    <!-- Dialog Feld zum Bearbeiten der Aufgabe. !!!Hinweis: nach der Bearbeitung wird bei erledigt nur 0 oder 1 angezeigt werden. Wird noch geändert -->
    <div id="popup" class="modal-box">
        <header>
            <a href="#" class="js-modal-close close">×</a>
            <h3>Daten ändern</h3>
        </header>
        <form id="form-task" name="form-task" class="form-horizontal" novalidate="">
            <div class="modal fade-in" id="thisModal" tabindex="-1" role="dialog" aria-labelledby="thisLabelModal" aria-hidden="true">
                <div class="modal-inner">
                    <div class="modal-body">
                        <div class="modal-inner-inputs">
                            <form id="form-task" name="form-task" class="form-horizontal" novalidate="">
                                {{ csrf_field() }}
                                <label class="label-show">Kategorie <br>
                                    <input type="text" class="input-boxes" id="category" name="category" value=""><br>
                                </label><br>
                                <label class="label-show">Aufgabe Bearbeiten <br>
                                    <input type="text" class="input-boxes" id="heading" name="heading" value=""><br>
                                </label><br>
                                <label class="label-show">Status <br>
                                    <input type="checkbox" class="input-boxes" id="done" name="done" value="1"><br>
                                </label><br>
                                </div>
                                <div class="modal-inner-area">
                                    <label class="show">Aufgaben <br>
                                        <textarea rows="12" cols="40" type="text" id="description" name="description" value="" ></textarea><br>
                                    </label><br>                   
                                </div>           
                        </div>           
                        <footer>
                            <button type="button" class="js-modal-close" id="btn-save" value="add">Änderungen speichern</button>
                            <input type="hidden" id="task_id" name="task_id" value="0"> 
                        </footer>
                    </div> 
                </div>
        </form>
    </div>
</div>
</div>

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Einbinden der js Datei-->
<script src="{{asset('/js/function.js')}}"></script>
@endsection