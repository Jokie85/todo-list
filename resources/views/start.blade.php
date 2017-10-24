@extends('layouts.app')

@section('content')
<div>
    <form method="post" action="/logout">
        {{ csrf_field() }}
        <input class="rainbow-button" id="logout" type="submit" value="Logout">
    </form>

    <marquee scrollamount="10" >
        <h1 class="run">To-Do Liste</h1> </marquee>

    <div class="btn-container">
        <div class="btn-container two">
            <a href="/addTask"> 
                <button type="button" id="btn-form"><span id="span-hover">To-Do Liste anlegen </span></button>
            </a>
        </div>
        <div class='btn-container three'>
            <a href="/show"> 
                <button type="button" id="btn-form"><span id="span-hover">Listen anzeigen </span></button>
            </a>
        </div> 
    </div>
</div>
@endsection 