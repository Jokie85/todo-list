@extends('layouts.app')

@section('content')
<!-- Link/Button zur Startseite-->
<a href="/show" id="back-button" class="rainbow-button" alt="Zurück"></a>
<form method="POST" action='/list'>

    <div>
        <div id="alert-slide">
            @if(session()->has('status'))
            <div class="alert alert-success" >
                <strong id="redirect-text"> {{ session()->get('status') }}</strong>
            </div>  
            @endif  
        </div>
    </div>

    <div id="border-list">  
        <div class="to-do-list"> 
            {{ csrf_field() }}  

            <h2 id="h2-heading">{{$cat->head_name}}</h2>
            <h4 id="h4-category">Kategorie:{{$cat->cat_name}}</h4><br><br><br>
            <div class="text"></div> 
            <div id="main-tasks">
                <h3 id="h3-task">Aufgaben:</h3>
                @foreach($task as $t)
                <!-- Wichtig um auch den Wert 0 zurück zu bekommen wenn die box unchecked ist oder wird -->
                <input type="hidden" name='status[{{ $t->id }}]' value="0">
                <p id="p-background"><input type="checkbox" name='status[{{ $t->id }}]' id="task-check" value="1" 
                    <?php
                    if ($t->done == 1) {
                        echo "checked";
                    }
                    ?> >

                    {{ $t->tas_name }}</p><br>     
                @endforeach<br>
            </div>
            <div class="text" id="bottom-line"></div> 
            <input type='submit' id="task-button" value="Speichern">
            <input type="hidden" name="hid" value="{{$t->heading_id}}">

        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- Einbinden der js Datei-->
<script src="{{asset('/js/function.js')}}"></script>
@endsection