<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=['menu','slug','status'];
    
    public function submenu(){
    	return $this->hasMany('App\Submenu');
    }
}
