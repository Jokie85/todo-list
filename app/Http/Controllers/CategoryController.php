<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Heading;
use App\Category;
use Auth;

class CategoryController extends Controller
{   
    // Es werden alle Kategorien aufgerufen
    public function loadCategory() {
        
      $category = Category::all();
      
      return view('addTask', compact('category'));

    }
     
    // Ausloggen des Users
    public function logout() {

        Auth::logout();
        return view('start');
    }
    
    // Speichern der Kategorie und übergabe der ID an Funktion "saveTodo"
    public function saveCategory($cat_name) {

        $category = new Category;
        $category->cat_name = $cat_name;
        $category->save();  
        
        $id = $category->id;
        return $id;
    }
}
