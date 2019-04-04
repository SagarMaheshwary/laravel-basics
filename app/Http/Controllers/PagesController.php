<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PagesController
    |--------------------------------------------------------------------------
    | We will use this controller to render basic pages e.g home page or 
    | about page etc.
    |
    */

    /**
     * Show index page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pages.index');
    }

    /**
     * Show About page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function about(){
        return view('pages.about');
    }
}
