<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Heading;
use App\Category;
use Auth;

class TaskController extends Controller {
    // ID wird übergeben um alle Aufgaben(Tasks) zu ermitteln die zu folgender 
    // Titel(heading_id)passt
    public function getTask(Request $request) {

        $id = $request->show;
        $cat = Category::join('heading', 'category.id', '=', 'heading.category_id')
                ->where('heading.id', $id)
                ->select('category.*', 'heading.*')
                ->first();
        $task = Task::where('heading_id', $id)->get();

        return view('list', compact('task', 'cat'));
    }
    
    //Wenn eine Aufgabe checked oder unchecked ist, wird es in der DB geändert
    public function saveCheckedTasks(Request $request) {

        $this->validate($request, [
            'status' => 'required',
        ]);   
        $taskid = $request['status'];

        foreach ($taskid as $id => $value) {
            
            Task::where('id', $id)
                    ->update(['done' => $value]);
        }   
        $id = $request->hid;
        
        return redirect()->back()->with('status', 'Änderungen wurden übernommen');
    }
    
    // Hier werden alle Aufgaben in die Datenbank geschrieben
    public function saveTasks($tasks, $headingId) {

        $counted = count($tasks);
        for ($i = 0; $i < $counted; $i++) {

            Task::insert([
                ['tas_name' => $tasks[$i],
                    'heading_id' => $headingId,
                    'done' => 0,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString()]
            ]);
        }
    }
    
    //Wenn alle Aufgaben erledigt sind setzt diese Funktion in der Tabelle 
    //Heading , 'ges_done' auf erledigt(1)
    public function test($hid){
        
        $done = Task::where('heading_id', $hid)
                    ->get();
        $offen = 0; $erledigt = 0;
        foreach ($done as $d ) {
            if($d->done == 1){
                $erledigt++;
            }
            else{
                $offen++;   
            }
        }
        if($offen == 0){
            Heading::where('id',$hid)
                    ->update(['ges_done' => 1]);
            }
        else{
            Heading::where('id',$hid)
                    ->update(['ges_done' => 0]);
         }
    }

}
