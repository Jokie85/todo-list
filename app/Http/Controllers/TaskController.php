<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;


class TaskController extends Controller
{
    // Die Erzeugung und das abfragen wurde mit Eloquent gelöst. 
    // Funtion um die Daten von der View '/addTask in die Datenbank zu speichern.
    
    public function saveTask(Request $request) {
        
        $this->validate($request, [
            'category' => 'required|min:2',
            'heading' => 'required|min:2',
            'description' => 'required|min:2'
        ]);
        // Hier wird die User ID abgefragt und in die Variable $user_id
        $user_id = Auth::id();
        
        $task = new Task;
        $task->user_id = $user_id;
        $task->category = $request->category;
        $task->heading = $request->heading;
        $task->description = $request->description;
        $task->done = 0;
        $task->save();
        // Zurück zur View '/addTask'
        return view('addTask');
    }
    // Hier werden alle Daten aus der Tabelle 'list' über das Model Task geholt, 
    // die dem eingeloggten User entsprechen.
    public function getUserTasks() {
        // Hier wird die User ID abgefragt und in die Variable $user_id
        $user_id = Auth::id();
        
        $usertasks = Task::where('user_id', $user_id)
                     ->get();
        // Zurück zur Seite '/show', mit den entsprechenden Daten(array).
        return view('show', compact('usertasks'));       
    }
    
}
