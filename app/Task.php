<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $table = 'Task';
    protected $fillable = ['tas_name','done'];
    
        public function heading() {
        return $this->belongsTo('App\Heading');
    }
}
