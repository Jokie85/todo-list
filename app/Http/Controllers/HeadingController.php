<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Heading;
use App\Category;
use Auth;
use DB;

class HeadingController extends Controller {
    // Es werden alle Daten aufgerufen die auf der Seite "show.blade" angezeigt werden
    public function getAll() {

        $user_id = Auth::id();
        $data = DB::table('category')
                ->join('heading', 'category.id', '=', 'heading.category_id')
                ->where('heading.user_id', $user_id)
                ->select('category.cat_name', 'heading.*')
                ->orderby('category.cat_name')
                ->get();
        $cat = DB::table('category')
                ->select('category.id', 'category.cat_name')
                ->get();
        $tas = DB::table('task')
                ->join('heading', 'task.heading_id', '=', 'heading.id')
                ->where('heading.id', 4)
                ->select('task.*')
                ->get();
        return view('show', compact('data', 'cat', 'tas'));
    }
    // Anlegen der To-Do-Liste
    public function saveTodo(Request $request) {

        $this->validate($request, [
            'heading' => 'required |min:1',
            'newtask' => 'required',
        ]);
        
        $value = (int)$request->radiocategory;

        $headingController = new HeadingController;
        $taskController = new TaskController;
        $categoryController = new CategoryController;
        
        if($value == 1){
            $taskController->saveTasks($request['newtask'], 
                 $headingController->saveHeading(
                         $request->category, $request->heading));      
        }
        else{
            $taskController->saveTasks($request['newtask'],
                 $headingController->saveHeading(
                         $categoryController->saveCategory(
                                  $request->addCategory), $request->heading));   
        }

        return redirect()->back()->with('status', 'Erfolgreich:   To-Do Liste wurde gespeichert'); 
    }
    //Speichert den Titel und übergiebt die ID an die Funktion "saveTodo"
    public function saveHeading($category_id,$heading_name){
        
        $user_id = Auth::id();
        $heading = new Heading;
        $heading->category_id = $category_id;
        $heading->user_id = $user_id;
        $heading->head_name = $heading_name;
        $heading->ges_done = 0;
        $heading->save(); 
        
        $id = $heading->id;
        return $id;
    }

}
