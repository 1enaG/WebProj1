<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Actor; 

class Film extends Model
{
   protected $guarded = []; 

   protected $fillable =[ // I dunno what this thing is for 
      'title', 'year', 'group_id', 
   ];

   public function actors(){
      return $this->belongsToMany(Actor::class); 
  }

  public function genre(){
     return $this->belongsTo(
        Genre::class, 
        'genre_id', 
        'id'
     ); 

  }
 

}



   // public function actors() 
   // {
   //    return $this->belongsToMany(Actor::class, 'actor_films'); //connected by actor_films table 
   // }