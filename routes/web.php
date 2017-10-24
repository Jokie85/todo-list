<?php
use Illuminate\Http\Request;
use App\Category;
use App\Heading;

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

//Gibt die Seite '/addTask' aus und prüft vorher ob Benutzer eingelogt ist.
    Route::get('/addTask', 'CategoryController@loadCategory')->middleware('auth');
    
// Es wird im 'TaskController' auf die Funktion 'saveTask zugegriffen um die 
// Daten auf 'addTask' zu speichern
    Route::post('/addTask', 'HeadingController@saveTodo')->middleware('auth');

// Es wird im 'TaskController' auf die Funktion 'saveTask' zugegriffen,
// um alle Daten von dem eingeloggtem Benutzer anzuzeigen. 
    Route::get('/show' , 'HeadingController@getAll')->middleware('auth');


    

    
// Auf der Seite '/list' wird mit der Funktion"getTask" alle Aufgaben aufgerufen
    Route::get('/list' , 'TaskController@getTask')->middleware('auth');
    
// Auf der Seite '/list' wird mit der Funktion"saveCheckedTasks" über post gespeichert
    Route::post('/list' , 'TaskController@saveCheckedTasks')->middleware('auth');
    
// Auf der Seite '/show' werden alle Daten ausgegeben die über die Funktion "getAll"abgerufen werden.
    Route::get('/show' , 'HeadingController@getAll')->middleware('auth');
// Hier wird nach der Id des ausgewähltem Tasks gesucht und zurückgegeben.
    Route::get('/show/{taskid?}',function($task_id){
        //$task = Heading::find($task_id);
        $task = Category::join('heading', 'category.id','=', 'heading.category_id')
                        ->where('heading.id',   $task_id)
                        ->select('category.*', 'heading.*')
                        ->first();

        return Response::json($task);
    })->middleware('auth');

//Hier wird der Task mit der ausgewählten ID gelöscht
    Route::delete('/show/{taskid?}',function($task_id){
        $task = Heading::destroy($task_id);

        return Response::json($task);
    })->middleware('auth');

// Alle Daten die im Dialog Fenster geändert wurden werden gespeichert.
    Route::put('/show/{taskid?}',function(Request $request,$task_id){
        $user_id = Auth::id();
        $task = Heading::find($task_id);

        $task->category_id = $request->category;
        $task->user_id = $user_id;
        $task->head_name = $request->heading;
        $task->ges_done = $request->done;
        $task->save();

        return Response::json($task);
    })->middleware('auth');

Auth::routes();
Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
Route::post('/', 'CategoryController@logout');


