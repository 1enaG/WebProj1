<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Film; 

class Genre extends Model
{
    //

    public function genres(){
        //return $this->belongsToMany(Film::class);  //FILMS!
    }

    public function films(){ //returns the films of one particular genre 
        return $this->hasMany(
            Film::class, 
            'genre_id', 
            'id'
        ); 
    } //filters by genre_id! 

}