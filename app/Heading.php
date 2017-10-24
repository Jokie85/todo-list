<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{

    protected $table = 'Heading';
    protected $fillable = ['head_name'];
    
    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function tasks() {
        return $this->hasMany('App\Task');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }
}
