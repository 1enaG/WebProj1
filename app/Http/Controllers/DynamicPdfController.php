<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film; //to get data from here 
use App\Genre;

use DB; //predefined class (seemingly)
use PDF; //alias of the plugin class we've installed 

class DynamicPdfController extends Controller
{
    //method that will execute when we call this class: 
    function index(){
       // $film_data; //for array of data 
      // $films = Film::all(); //array of objects 
      $filmsData = $this->getFilmData(); 
      return view('pdf/dynamic_pdf')->with('filmsData', $filmsData); 
    }

    function getFilmData(){
        $filmData = DB::table('films')->limit(10)->get();
        return $filmData; 
    }

    //converts html format to pdf using DomPDF: 
    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper'); 
        $pdf->loadHTML($this->convertFilmDataToHtml());
        //loadHTML is the func that converts data to pdf  
        return $pdf->stream();  //return!
        //stream func allows to show pdf file in browser 
    }

    //returns data in html format:
    function convertFilmDataToHtml(){
        $filmData = $this->getFilmData(); //array 

        $output = '
        <h3 align="center">Film Data</h3>
        <table width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="30%">Film title</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Year</th>
        </tr>
        ';  //header of the table 

        foreach($filmData as $film ){ //contents
            $output .= '
            <tr>
                <td style="border: 1px solid; padding:12px;" width="30%">
                '.$film->title.'
                </td>

                <td style="border: 1px solid; padding:12px;" width="30%">
                '.$film->year.'
                </td>
            </tr>
            '; 
        }

        $output.='</table>'; 

        return $output; 
    }//end of convertToHtml


}
