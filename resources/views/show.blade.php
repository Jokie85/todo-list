@extends('layouts.app')

@section('content')
<!-- Link/Button zur Startseite-->
<a href="/" id="back-button" class="rainbow-button" alt="Zurück"></a>

<div class="back-button">
    <form method="get" action="/list">
        {{ csrf_field() }}
        <div class="table-container">
            <table class="table-task">
                <thead id="table-head-background">
                <th>Kategorie</th>
                <th>Titel</th>
                <th>Status</th>
                <th>Erstellt am</th>
                <th></th>
                </thead>
                <tbody id="tasks-list" name="tasks-list">
                    <!-- Mit dem Blade-Tamplate, werden die von der Funktion 'getUserTasks' abgefragten Daten, 
                    mit einer Foreach schleife in die Zeilen einer Tabelle ausgegeben. -->
                    @foreach($data as $d)

                    <tr id="task{{$d->id}}" class="table-task-row">
                        <td id="category-td">{{$d->cat_name}}</td>

                        <td id="heading-td">{{$d->head_name}}</td>
                        <!-- Hier wird geprüfft ob die Aufgabe erledigt ist oder noch offen ist.
                             dem entsprechen soll die Ausgabe sein-->
                        @if($d->ges_done == 1)
                        <td id="state-td">erledigt</td>
                        @else
                        <td id="state-td">offen</td>
                        @endif
                        <td id="date-td">{{date('H:i:s / d.m.Y', strtotime($d->created_at))}}</td>
                        <td id="button-td">
                            <!-- Der Link(Button Bearbiten) öffnet ein Dialog Fenster, welches frei runtergeladen ist-->
                            <a class="js-open-modal" href="#" data-modal-id="popup"><button class="edit-task" value="{{$d->id}}">Bearbeiten</button></a>
                            <button  class="todo-task" name="show" value="{{$d->id}}">Aufgaben anzeigen</button>
                            <button type="button" class="delete-task" value="{{$d->id}}">Löschen</button>   
                        </td>
                    </tr>     

                    @endforeach
                </tbody>
            </table> 
        </div> 
    </form>
    <!-- Dialog Feld zum Bearbeiten der Aufgabe. -->
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
                                    <select class="input-boxes" id="category" name="category">
                                        @foreach($cat as $c)
                                        <option  value="{{$c->id}}">{{$c->cat_name}}</option>
                                        @endforeach
                                    </select>
                                </label><br>
                                <label class="label-show">Aufgabe Bearbeiten <br>
                                    <input type="text" class="input-boxes" id="heading" name="heading" value=""><br>
                                </label><br>
                                <label class="label-show">Status gesamt: <br>
                                    <input type="checkbox"  id="done" name="done" value="1"><br>
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