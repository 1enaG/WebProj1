<?php

namespace App\Http\Controllers;

use App\Film;
use App\Actor; 
use App\Genre; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; //! for your validation to work!
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{

    private $genre; 

    public function __construct(Request $request){
        $this->middleware('auth'); 
        //if user is not authenticated, they will not have access to any routes of this class's methods!

        $this->genre = Genre::find($request->route('gnrid')); 
        view()->share(
            'genre_filter_id', $request->route('gnrid')
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($gnr) // $genre_id = nullworks with or without a parameter: routes '/films' OR '/films/genre/{id}'
    { 
        if($this->genre){
            //$genre = Genre::find($genre_id); 
            $films = $this->genre->films->sortByDesc('year'); //films of a particular genre
        }else{
            // $genre=null; 
            $films = Film::all()->sortByDesc("year");  //all films 
        }

        
        return view('films/index', [
            'films' => $films, //dunno if that would work (year=string!)
            'pageTitle' => 'Films', //dunno if i need this one 
            'genres' => Genre::all()->sortBy('genre_name'),  //for a dropdown with filter options 
            //'genre_filter' => $genre, //for the current filter value

        ]);  //returns list of films 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($gnr)
    {
        if(Auth::user() && Auth::user()->can('update', Film::class)){ //check user right to update 
            return view('films/create', [
                'actors' => Actor::all()->sortBy('name'), 
                'genres' => Genre::all()->sortBy('genre_name'), 
            ]);  //we send all actors there as well to be able to choose some out of them 
        }else{
            return redirect('genre/'.$gnr.'/films'); //back to films list 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($gnr, Request $request)
    {
        //should this be here?.. 
        if(Auth::user() && Auth::user()->can('update', Film::class)){ //check user right to update 
            $data = $this->validateData($request); 
            
            //\App\Film::create($data); 

            $actor = \App\Actor::find(\request('actor_id')); //test if works... 
            $film = new \App\Film();  //create new object 
            
            $film->title = \request('film-title'); 
            $film->year = \request('film-year'); 
            $film->genre()->associate(Genre::find($data['genre_id'])); 
            
            $film->save(); 
            // $film->actors()->attach($actor);
        
            return redirect('genre/'.$gnr.'/films');  //or just /films? 
        }
    }

  

    /**
     * Display the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show($gnr, Film $film)
    {

        // $user = User::find(1); 
        // foreach ($user->schools as $school) 
        // {
        //     echo $school->name;
        // }
        //$film->actors()->attach(2); - to get 2 results for actor 
        //dd($film->actors); 
        //passes in current film: 
        return view('films/show', [
            'film'=> $film,
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit($gnr, Film $film)
    {
        if(Auth::user() && Auth::user()->can('update', Film::class)){ //check user right to update 
            return view('films/edit', [
                'film' => $film, 
                'actors' => Actor::all()->sortBy('name'), 
                'genres' => Genre::all()->sortBy('genre_name'), 
            ]); 
        }else {
            return redirect('genre/'.$gnr.'/films'); //back to films list 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update($gnr, Request $request, Film $film)
    {
        if(Auth::user() && Auth::user()->can('update', Film::class)){ //check user right to update 
            $data = $this->validateData($request); 
            //dd(\request()->all()); - to output request 
        
            $film_actors = $request->input('film_actors'); 

            //$user->roles()->sync([1, 2, 3]); //array of IDs!
            $film->actors()->sync($film_actors); 
            //VALUE for checkbox! 
            //PATCH works if you go to films/ {{ $film->id }} and then redirect to '/films' !! 


            $film->title = \request('film-title');  //$data['film-title']; 
            $film->year = \request('film-year'); //$data['film-year']; 
            $film->genre()->associate(Genre::find($data['genre_id']));  //store ref to genre obj in film obj 

            $film->save(); 

            return redirect('genre/'.$gnr.'/films'); 
        }else{
            //wihtout updating anything 
            return redirect('genre/'.$gnr.'/films'); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy($gnr, Film $film)
    {
        $film->delete(); 
    }

    // public function destroy($id){
    //     $film = \App\Film::find($id);
    //     $film->delete(); 
    // }

//helper methods: 

    private function validateData($data){
        return $this->validate($data, [ //array of requirements, array of responses to requirements not met 
            'film-title' => 'required|max:50', 
            'film-year' => 'min:4|max:4',
            'actor_id' => Rule::exists('actors', 'id'), 
            'genre_id' => Rule::exists('genres', 'id'), 
        ], [
            'film-title.required' => 'Title field cannot be empty!', 
            'film-title.max' => 'Title should not exceed 50 characters', 
            'film-year.min' => 'Year cannot be less than 4 digits', 
            'film-year.max' => 'Year cannot be more than 4 digits',
            'actor_id.exists' => 'You have chosen a non-existent actor', 
            'genre_id.exists' => 'You have chosen a non-existent genre', 
        ]); 
    }
   
}
