<?php

use Illuminate\Support\Facades\Route;


Route::get('/', "PagesController@home"); //->middleware('pageNotAllowed');
Route::get('/about', "PagesController@about");

Route::resource('/actors', "ActorsController"); //try this! 
Route::get('/actors-json', "ActorsController@getList");

Route::resource('/genres', 'GenreController'); 

//for Genres->Show Films -> filtered film list: 
Route::resource('genre/{gnrid}/films', 'FilmController'); 

//instead of: 
//Route::resource('/films', 'FilmController'); 
//and
//Route::get('films/genre/{id}', "FilmController@index"); //list of films filtered by genre! 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/admin', 'PagesController@admin')->middleware('auth');
//Route::get('/admin', 'UserController@index')->middleware('auth');
Route::resource('/users', 'UserController'); //->middleware('auth'); 
//Route::delete('user/{id}', 'UserController@destroy')->name('user.destroy'); //users? 

Route::get('/dynamic_pdf', 'DynamicPdfController@index'); 
Route::get('/dynamic_pdf/pdf', 'DynamicPdfController@pdf'); 

