@extends('layouts.app')

@section('content')
<!-- Link/Button zur Startseite-->
<a href="/" id="back-button" class="rainbow-button" alt="Zurück"></a>
<!--Im TaskController steht die Funktion für das Speichern der Daten. -->
<form method="POST" action="/addTask">
    <div>
        <div id="alert-slide">
            @if(session()->has('status'))
            <div class="alert alert-success" >
                <strong id="redirect-text"> {{ session()->get('status') }}</strong>
            </div>  
            @endif  
        </div>
    </div>
    <div>


        <div id="addTask" ><br>  <br> 
            <h1 id="h1-main-titel"> To-Do Liste erstellen:</h1>
            <div class="line"></div> 
            <!--Schutz vor Cross-Site-Request-Forgery -->
            {{ csrf_field() }}

            <div id="change-category">
                <label class="label-headings">
                    <input type="radio" name="radiocategory" value="1" checked>Kategorie auswählen: <br> 
                    <select class="input-boxes" id="changeCat" name="category">
                        @foreach($category as $cat)    
                        <option  value="{{$cat->id}}">{{$cat->cat_name}}</option>
                        @endforeach    
                    </select> 
                </label>
            </div>
            <div id="addcategory{{ $errors->has('addCategory') ? ' has-error' : '' }}">
                <label class="label-headings">
                    <input type="radio" value="2" name="radiocategory"> Neue Kategorie:<br>
                    <input type="text" class="input-boxes" id="addCat" name="addCategory" disabled required><br><br>
                </label>
            </div><br>

            <div class="heading-text" id="heading-text {{ $errors->has('heading') ? ' has-error' : '' }}">
                <label class="label-headings"> Titel<br>  
                    <input class="input-boxes" type="text" name="heading"required><br>  <br>   
                </label>
            </div>
            <div class="add-inputs {{ $errors->has('newtask[]') ? ' has-error' : '' }}"> 
                <label class="label-headings">Aufgaben<br>  
                    <input class="input-boxes" type="text" name="newtask[]" required><button type="button" class="more-inputs"  name="more-inputs" >+</button> 

                </label>

            </div><div class="line"></div> 
            <!--Speichert die Daten mit der Funktion 'saveTask' in die datenbank->tasklist = tabelle->list -->
            <input id="submit-task"  type="submit" value="Liste speichern" />
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Einbinden der js Datei-->
<script src="{{asset('/js/function.js')}}"></script>

@endsection