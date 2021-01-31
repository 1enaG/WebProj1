<?php

namespace App\Http\Controllers;


use App\Actor; 

use App\Film; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActorsController extends Controller
{
    //
    public function __construct(Request $request){
        $this->middleware('auth'); 
    }
    public function index(){
        $actors = \App\Actor::all()->sortBy("name");
        return view('actors/index', [ //actors/index     /index 
            'actors' => $actors,
            'pageTitle' => 'All actors'
        ]);
        
    }//end of index 
    public function getList(){
        return \App\Actor::all(); 
    }

    public function create(){
        if(Auth::user() && Auth::user()->can('update', Actor::class)){ //check user right to update 
            return view('actors/create'); //NOT actors/create
        }else{
            return redirect('/actors'); //RETURN!!
        }
    }
    public function store(){ //store data in a new Actor obj 
        //validation: 
        $data=request()->validate([
            'actor-name'=>'required',
            'actor-country'=>['required', 'max:30'],
            'actor-year'=>'required|min:4|max:4'

        ], 
        [
            'actor-name.required'=>'Name field is required!',
            'actor-country.required'=>'Country field is required!',
            'actor-country.max'=>'Country field must be less than 30 digits long', 
            'actor-year.required'=>'Year field is required!',
            'actor-year.min'=>'Year field must be 4 digits long', 
            'actor-year.max'=>'Year field must be 4 digits long', 

            

        ]); //if validation fails, exits method (following code won't be executed)

        
        $actor = new \App\Actor(); 
        //$actor->name=$data['actor-name'];  //alternative way to access data
        $actor->name = \request('actor-name'); 
        $actor->country = \request('actor-country'); 
        $actor->year = \request('actor-year'); 

      
        $actor->save(); 
        return redirect('/actors');        

        //Ways to output data as an array: 
        // dd([
        //     'actor_name' => \request('actor-name'),
        //     'actor_country'=> \request('actor-country')
        // ]);
        //return \request()->all(); //output everything we've been sent from the form 
        
    }// end of store

    public function edit($id){
        if(Auth::user() && Auth::user()->can('update', Actor::class)){ //check user right to update
            $actor = \App\Actor::find($id); 
            return view('actors/edit', [ //maybe just /edit? 
                'actor'=>$actor, 
                'films'=>Film::all()->sortBy('year'), 
            ]);
        }else{
            return redirect('/actors'); 
        }
    }

  

    public function update($id){
        //validation: 
        $data=request()->validate([
            'actor-name'=>'required',
            'actor-country'=>['required', 'max:30'],
            'actor-year'=>'required|min:4|max:4'

        ], 
        [
            'actor-name.required'=>'Name field is required!',
            
            'actor-country.required'=>'Country field is required!',
            'actor-country.max'=>'Country field must be less than 30 digits long', 
            'actor-year.required'=>'Year field is required!',
            'actor-year.min'=>'Year field must be 4 digits long', 
            'actor-year.max'=>'Year field must be 4 digits long', 

            

        ]); //if validation fails, exits method (following code won't be executed)
        $actor = \App\Actor::find($id); 
        
        $actor_films = request()->input('actor_films'); 
        $actor->films()->sync($actor_films);

        $actor->name = \request('actor-name'); 
        $actor->country = \request('actor-country'); 
        $actor->year = \request('actor-year'); 

        $actor->save(); 

        return redirect('/actors'); 

    }

    // public function update(Actor $actor){
    //     $actor->update( \request([
    //         'actor-name', 
    //         'actor-country', 
    //         'actor-year'
    //     ])); 

    //     $actor->save(); 

    //     return redirect('/actors'); 

    // }

    public function destroy($id){
        $actor = \App\Actor::find($id);
        $actor->delete(); 
    }

    public function show($id){
        $actor = \App\Actor::find($id); //find actor in db 
        //return the show template (show.blade.php) with actor data

        //dd($actor->films); 
        return view('actors/show', [ //   actors/show 
            'films'=>$actor->films->sortByDesc('year'), 
            'actor'=>$actor
        ]);
    }


}
