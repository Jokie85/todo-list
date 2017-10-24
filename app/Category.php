<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Category';
    protected $fillable = ['cat_name'];
    
    
    public function headings() {
        return $this->hasMany('App\Heading');
    }

}
