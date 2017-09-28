<?php
use Illuminate\Http\Request;
use App\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Führt zur Startseite wenn man eingeloggt ist.
Route::get('/', function () {
    return view('start');
})->middleware('auth');

// !!!Für weiter Entwicklung!!!
/*Route::get('/addCat', function () {
    return view('addCat');
})->middleware('auth');*/

//Gibt die Seite '/addTask' aus und prüft vorher ob Benutzer eingelogt ist.
Route::get('/addTask', function () {
    return view('addTask');
})->middleware('auth');
// Es wird im 'TaskController' auf die Funktion 'saveTask zugegriffen um die 
// Daten auf 'addTask' zu speichern
Route::post('/addTask', 'TaskController@saveTask');

// Es wird im 'TaskController' auf die Funktion 'saveTask' zugegriffen,
// um alle Daten von dem eingeloggtem Benutzer anzuzeigen. 
Route::get('/show' , 'TaskController@getUserTasks')->middleware('auth');

// Hier wird nach der Id des ausgewähltem Tasks gesucht und zurückgegeben.
Route::get('/show/{taskid?}',function($task_id){
    $task = Task::find($task_id);

    return Response::json($task);
})->middleware('auth');

//Hier wird der Task mit der ausgewählten ID gelöscht
Route::delete('/show/{taskid?}',function($task_id){
    $task = Task::destroy($task_id);

    return Response::json($task);
})->middleware('auth');

// Alle Daten die im Dialog Fenster geändert wurden werden gespeichert.
Route::put('/show/{taskid?}',function(Request $request,$task_id){

    $task = Task::find($task_id);

    $task->category = $request->category;
    $task->heading = $request->heading;
    $task->description = $request->description;
    $task->done = $request->done;
    $task->save();

    return Response::json($task);
})->middleware('auth');

Auth::routes();
Route::get('/start', 'HomeController@index')->name('home');
