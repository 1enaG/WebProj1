<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //

    public function films(){
        return $this->belongsToMany(Film::class);  //FILMS!
    }
}

//Tinker: REPL = read, eval, print, loop 
// (interface) - allows to interact with app via cmd 
// php artisan tinker 

