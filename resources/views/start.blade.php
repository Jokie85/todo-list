@extends('layouts.app')

@section('content')
<marquee scrollamount="10" >
 <h1 class="run">To-Do-Liste</h1> </marquee>

<div class="btn-container">
    <!-- Dieser Container wird bei der nächsten Erweiterung aktiv -->
    
    <!--<div class="btn-container one">
        <a href="/addCat">     
            <button type="button" id="btn-form"><span id="span-hover">Kategorie anlegen </span></button>
        </a>
    </div>-->
  
    <div class="btn-container two">
       <a href="/addTask"> 
           <button type="button" id="btn-form"><span id="span-hover">Aufgabe anlegen </span></button>
       </a>
    </div>
    <div class='btn-container three'>
        <a href="/show"> 
            <button type="button" id="btn-form"><span id="span-hover">Aufgaben anzeigen </span></button>
        </a>
    </div> 
</div>
@endsection
