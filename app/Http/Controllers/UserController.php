<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\UserRight; 
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth'); 
    }

    public function index(){
        $users = User::all()->sortBy("name");
        return view('users/index', [ //actors/index     /index 
            'users' => $users,
        ]);
        
    }//end of index 

    public function create(){
        if(Auth::user() && Auth::user()->can('update', User::class)){ //check user right to update 
            return view('users/create'); 
        }else{
            return redirect('/users'); 
        }
    }

    public function edit($id){
        //if i am doing this auth check , i have to register smth in kernel .... 
        if(Auth::user() && Auth::user()->can('update', User::class)){ //check user right to update
            $user = User::find($id); 
            return view('users/edit', [ 
                'user'=>$user,
                
                //'films'=>Film::all()->sortBy('year'),  //maybe also pass in rights or something... 
            ]);
        }else{
            return redirect('/users'); 
        }
    } //end of edit 

    //add an update function so we can store changes after submitting the edit form! 
    
    public function update($id){ 
        //validation can be put here if you want it 
        $user = \App\User::find($id); 

        $user->name = \request('user-name'); 
        $user->email = \request('user-email'); 
        $user->role = \request('user-role');

        //rights!!
        $user_rights = \request()->input('user_rights');   
        //maps right id to value!
        foreach($user_rights as  $key => $value){
            //find a userRight by id, set its value and save: 
            $userRight = \App\UserRight::find($key); 
            $userRight->right = $value; 
            $userRight->save();
            //see if it works - YES! IT DOES!!! :D 
        }

        $user->save(); 

        return redirect('/users'); 

    } //end of update 

    public function store(){ 
        //validation can be put here if you want it 
        //ADD AUTH HERE!!
        $user = new User();  

        $user->name = \request('user-name'); 
        $user->email = \request('user-email'); 
        $user->password = \request('user-password');
        $user->role = \request('user-role');

        //rights!!
        $user_rights = \request()->input('user_rights');   
        //maps right id to value!

        $user->save(); 
        // ! HERE keys are MODELS and values are RIGHTS 
        foreach($user_rights as  $key => $value){
            //find a userRight by id, set its value and save: 
            //$userRight = \App\UserRight::find($key); 
            $userRight = new UserRight(); 
            $userRight->model = $key; 
            $userRight->right = $value; 
            $userRight->user_id = $user->id; //see if it works...   
            $userRight->save();
          
        }

        return redirect('/users'); 
    } //end of store


    public function destroy($id)
    { 

        $user = \App\User::find($id); 
        $user->delete(); 
     
    }

}